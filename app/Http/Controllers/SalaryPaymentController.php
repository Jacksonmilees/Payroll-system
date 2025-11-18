<?php
namespace App\Http\Controllers;
use App\Attendance;
use App\Bonus;
use App\Deduction;
use App\Loan;
use App\Payroll;
use App\SalaryPayment;
use App\User;
use App\SalaryPaymentDetails;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use PDF;
use Auth;

class SalaryPaymentController extends Controller {
	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index() {
		$employees = Payroll::query()
		->leftjoin('users', 'payrolls.user_id', '=', 'users.id')
		->leftjoin('designations as designations', 'users.designation_id', '=', 'designations.id')
		->orderBy('users.name', 'ASC')
		->where('users.access_label', '>=', 2)
		->where('users.access_label', '<=', 3)
		->get(['designations.designation', 'users.name', 'users.name_prefix', 'users.id'])
		->toArray();
		return view('administrator.hrm.salary_payment.manage_payment', compact('employees'));
	}
	/**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function go(Request $request) {
		request()->validate([
			'user_id' => 'required',
			'salary_month' => 'required',
		], [
			'user_id.required' => 'The employee name field is required',
		]);
		return redirect('/hrm/salary-payments/manage-salary/' . $request->user_id . '/' . $request->salary_month);
	}
	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function create($user_id, $salary_month) {
		$period = Carbon::parse($salary_month . '-01');
		$context = $this->buildSalaryContext($user_id, $period);

		if (empty($context['salary'])) {
			return redirect('/hrm/payroll')->with('exception', 'Please configure the payroll details before processing salary payments.');
		}

		if (!empty($context['salary_payment'])) {
			$salary_payment_details = SalaryPaymentDetails::where('salary_payment_id', $context['salary_payment']->id)->get();
			return view('administrator.hrm.salary_payment.salary_payment_details', [
				'user_id' => $user_id,
				'salary_month' => $salary_month,
				'deductions' => $context['deductions'],
				'user' => $context['user'],
				'employee_salaries' => $context['employee_salaries'],
				'salary_payment_details' => $salary_payment_details,
				'salary_payment' => $context['salary_payment'],
				'attendanceSummary' => $context['attendance_summary'],
			]);
		}

		return view('administrator.hrm.salary_payment.make_salary', [
			'salary' => $context['salary'],
			'bonuses' => $context['bonuses'],
			'deductions' => $context['deductions'],
			'allowances' => $context['allowances'],
			'loans' => $context['loans'],
			'user_id' => $user_id,
			'salary_month' => $salary_month,
			'user' => $context['user'],
			'attendanceSummary' => $context['attendance_summary'],
			'pay_basis' => $context['pay_basis'],
			'default_payment_date' => $context['default_payment_date'],
		]);
	}
	public function pdf($user_id, $salary_month) {
		$period = Carbon::parse($salary_month . '-01');
		$context = $this->buildSalaryContext($user_id, $period);

		if (empty($context['salary_payment'])) {
			return redirect('hrm/salary-payments/manage-salary/' . $user_id . '/' . $salary_month)->with('exception', 'No payslip found for the selected month.');
		}

		$salary_payment_details = SalaryPaymentDetails::where('salary_payment_id', $context['salary_payment']->id)->get();
		$adeductions = Deduction::whereYear('deduction_month', '=', $period->year)
			->whereMonth('deduction_month', '=', $period->month)
			->where('user_id', '=', $user_id)
			->where('deletion_status', '=', 0)
			->get(['deduction_name', 'deduction_amount']);

		$houselevy = Payroll::where('user_id', $user_id)->first();

		$grosssalry = 0;
		if (!empty($context['salary'])) {
			$grosssalry = ($context['salary']['basic_salary'] ?? 0)
				+ ($context['salary']['house_rent_allowance'] ?? 0)
				+ ($context['salary']['medical_allowance'] ?? 0)
				+ ($context['salary']['special_allowance'] ?? 0)
				+ ($context['salary']['other_allowance'] ?? 0);

			foreach ($context['allowances'] as $allowance) {
				$grosssalry += $allowance['deduction_amount'];
			}
		}

		$pdf = PDF::loadView('administrator.hrm.salary_payment.pdf', [
			'grosssalry' => $grosssalry,
			'salary' => $context['salary'],
			'user_id' => $user_id,
			'salary_month' => $salary_month,
			'user' => $context['user'],
			'employee_salaries' => $context['employee_salaries'],
			'salary_payment_details' => $salary_payment_details,
			'salary_payment' => $context['salary_payment'],
			'houselevy' => $houselevy,
			'adeductions' => $adeductions,
			'attendanceSummary' => $context['attendance_summary'],
		]);
		$file_name = 'Salary-' . $context['user']['employee_id'] . '.pdf';
		return $pdf->download($file_name);
	}
	/**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function store(Request $request) {
		$salary = request()->validate([
			'payment_amount' => 'required|numeric',
			'payment_type' => 'required',
			'note' => 'nullable',
			'payment_date' => 'nullable|date',
		]);
		$items = count($request->item_name);
		// print_r($request->loan_id); exit;
		$loanCount = isset($request->loan_id) && !empty($request->loan_id) ? count($request->loan_id) : 0;
		$period = Carbon::parse($request->payment_month . '-01');
		$paymentDate = !empty($request->payment_date) ? Carbon::parse($request->payment_date) : $period->copy()->endOfMonth();
		$attendanceSummary = $this->summarizeAttendance($request->user_id, $period->copy()->startOfMonth(), $period->copy()->endOfMonth());
		$payroll = Payroll::where('user_id', $request->user_id)->first();
		$payBasis = $payroll ? ($payroll->pay_structure ?? 'monthly') : 'monthly';
		$result = SalaryPayment::create([
			'created_by' => auth()->user()->id,
			'user_id' => $request->user_id,
			'gross_salary' => $request->gross_salary,
			'total_deduction' => $request->total_deduction,
			'net_salary' => $request->net_salary,
			'provident_fund' => $request->provident_fund,
			'payment_amount' => $request->payment_amount,
			'payment_month' => $period->toDateString(),
			'payment_date' => $paymentDate->toDateString(),
			'work_days' => $attendanceSummary['work_days'],
			'work_hours' => $attendanceSummary['work_hours'],
			'pay_basis' => $payBasis,
			'payment_type' => $request->payment_type,
			'note' => $request->note,
		]);
		$inserted_id = $result->id;
		if (!empty($inserted_id)) {
			for ($i = 0; $i < ($items); $i++) {
				SalaryPaymentDetails::create([
					'salary_payment_id' => $inserted_id,
					'item_name' => $request->item_name[$i],
					'amount' => $request->amount[$i],
					'status' => $request->status[$i],
				]);
			}
			for ($i = 0; $i < ($loanCount); $i++) {
				$loan = Loan::find($request->loan_id[$i]);
				$loan->remaining_installments = $request->remaining_installments[$i] - 1;
				$loan->save();
			} //Old code
			
			return redirect('hrm/salary-payments')->with('message', 'Add successfully.');
		}
		return redirect('hrm/salary-payments')->with('exception', 'Operation failed !');
	}
	/**
	* Display the specified resource.
	*
	* @param  \App\Payroll  $payroll
	* @return \Illuminate\Http\Response
	*/
	public function show() {
		return view('administrator.hrm.salary_payment.generate_payslip');
	}
	/**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function generate(Request $request) {
		request()->validate([
			'salary_month' => 'required',
		], [
			'salary_month.required' => 'The salary month field is required',
		]);
		$salary_month = $request->salary_month;
		return redirect('/hrm/generate-payslips/salary-list/' . $salary_month);
	}
/**
	* Display the specified resource.
	*
	* @param  \App\Payroll  $payroll
	* @return \Illuminate\Http\Response
	*/
	public function salarySheetSearch(){
		return view('administrator.hrm.salary_payment.salarySheetSearch');
	}
/**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function salarySheetView(Request $request) {
		$salary_month=$request->salary_month."-01";
		return view('administrator.hrm.salary_payment.salarySheetView', compact('salary_month'));
	}
	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function list($salary_month) {
		$date = $salary_month;
		$month = date("m", strtotime($date));
		$year = date("Y", strtotime($date));
		$user = Auth::user();
		$employees = Payroll::query()
		->leftjoin('users', 'payrolls.user_id', '=', 'users.id')
		->leftjoin('designations as designations', 'users.designation_id', '=', 'designations.id')
		->orderBy('users.name', 'ASC')
		->where('users.access_label', '>=', 2)
		->where('users.access_label', '<=', 3);
		$bonuses = Bonus::whereYear('bonus_month', '=', $year)
		->whereMonth('bonus_month', '=', $month)
		->where('deletion_status', '=', 0);
		$deductions = Deduction::whereYear('deduction_month', '=', $year)
		->whereMonth('deduction_month', '=', $month)
		->where('deletion_status', '=', 0)
		->where('type', 'deduction');
		$allowances = Deduction::whereYear('deduction_month', '=', $year)
		->whereMonth('deduction_month', '=', $month)
		->where('deletion_status', '=', 0)
		->where('type', 'allowance');
		$loans = Loan::where('remaining_installments', '>', 0);
		$salary_payments = SalaryPayment::whereYear('payment_month', '=', $year)
		->whereMonth('payment_month', '=', $month);
		if ($user->access_label != 1) {
			$employees = $employees->where('user_id', $user->id);
			$bonuses = $bonuses->where('user_id', $user->id);
			$deductions = $deductions->where('user_id', $user->id);
			$loans = $loans->where('user_id', $user->id);
			$salary_payments = $salary_payments->where('user_id', $user->id);
		}
		$employees	= $employees->get(['payrolls.*', 'designations.designation', 'users.name', 'users.name_prefix', 'users.id as user_id'])
					  ->toArray();
		$bonuses = $bonuses->get(['bonus_name', 'bonus_amount', 'user_id'])->toArray();
		$deductions = $deductions->get(['deduction_name', 'deduction_amount', 'user_id'])->toArray();
		$allowances = $allowances->get(['deduction_name', 'deduction_amount', 'user_id'])->toArray();
		$loans = $loans->get(['id', 'user_id', 'loan_name', 'loan_amount', 'remaining_installments', 'number_of_installments'])->toArray();
		$salary_payments = $salary_payments->get(['user_id'])->toarray();
        // dd($employees);
		return view('administrator.hrm.salary_payment.employees_salary_list', compact('employees', 'salary_month', 'bonuses', 'deductions','allowances', 'loans', 'salary_payments'));
	}
	/**
	* Display the specified resource.
	*
	* @param  \App\Payroll  $payroll
	* @return \Illuminate\Http\Response
	*/
	public function provident_fund() {
		$employees = Payroll::query()
		->leftjoin('users', 'payrolls.user_id', '=', 'users.id')
		->leftjoin('designations as designations', 'users.designation_id', '=', 'designations.id')
		->orderBy('users.name', 'ASC')
		->where('users.access_label', '>=', 2)
		->where('users.access_label', '<=', 3)
		->get(['designations.designation', 'users.name', 'users.name_prefix', 'users.id', 'users.created_at', 'users.employee_id', 'payrolls.provident_fund_contribution', 'payrolls.provident_fund_deduction'])
		->toArray();
		$provident_funds = DB::table('salary_payments')
		->leftjoin('users', 'salary_payments.user_id', 'users.id')
		->select(DB::raw('sum(salary_payments.provident_fund) AS total_provident_fund'), 'salary_payments.user_id')
		->groupBy('salary_payments.user_id')
		->get();
		return view('administrator.hrm.provident_fund.provident_funds', compact('employees', 'provident_funds'));
	}

	protected function buildSalaryContext($userId, Carbon $period)
	{
		$month = (int) $period->format('m');
		$year = (int) $period->format('Y');

		$salary_payment = SalaryPayment::whereYear('payment_month', '=', $year)
			->whereMonth('payment_month', '=', $month)
			->where('user_id', $userId)
			->first();

		$salary = Payroll::where('user_id', $userId)->first();
		$attendanceSummary = $this->summarizeAttendance($userId, $period->copy()->startOfMonth(), $period->copy()->endOfMonth());
		$transformedSalary = $this->transformSalaryForPeriod($salary, $attendanceSummary);

		$bonuses = Bonus::whereYear('bonus_month', '=', $year)
			->whereMonth('bonus_month', '=', $month)
			->where('user_id', '=', $userId)
			->where('deletion_status', '=', 0)
			->get(['bonus_name', 'bonus_amount'])
			->toArray();

		$deductions = Deduction::whereYear('deduction_month', '=', $year)
			->whereMonth('deduction_month', '=', $month)
			->where('user_id', '=', $userId)
			->where('deletion_status', '=', 0)
			->where('deductions.type', 'deduction')
			->get(['deduction_name', 'deduction_amount'])
			->toArray();

		$allowances = Deduction::whereYear('deduction_month', '=', $year)
			->whereMonth('deduction_month', '=', $month)
			->where('user_id', '=', $userId)
			->where('deletion_status', '=', 0)
			->where('deductions.type', 'allowance')
			->get(['deduction_name', 'deduction_amount'])
			->toArray();

		$loans = Loan::where('user_id', $userId)
			->where('remaining_installments', '>', 0)
			->get(['id', 'loan_name', 'loan_amount', 'remaining_installments', 'number_of_installments'])
			->toArray();

		$user = User::query()
			->leftjoin('designations', 'users.designation_id', '=', 'designations.id')
			->leftjoin('departments', 'designations.department_id', '=', 'departments.id')
			->where('users.id', $userId)
			->where('users.deletion_status', 0)
			->first([
				'users.id',
				'users.employee_id',
				'users.name',
				'users.name_prefix',
				'users.father_name',
				'users.mother_name',
				'users.kra_no',
				'users.nhif_no',
				'users.nssf_no',
				'users.avatar',
				'users.created_at',
				'designations.designation',
				'departments.department',
			]);

		$userArray = $user ? $user->toArray() : [];

		$employee_salaries = SalaryPayment::where('user_id', $userId)
			->orderBy('payment_month', 'desc')
			->get()
			->toArray();

		return [
			'salary_payment' => $salary_payment,
			'salary' => $transformedSalary['data'],
			'pay_basis' => $transformedSalary['pay_basis'],
			'attendance_summary' => $attendanceSummary,
			'bonuses' => $bonuses,
			'deductions' => $deductions,
			'allowances' => $allowances,
			'loans' => $loans,
			'user' => $userArray,
			'employee_salaries' => $employee_salaries,
			'default_payment_date' => $period->copy()->endOfMonth()->toDateString(),
		];
	}

	protected function summarizeAttendance($userId, Carbon $startDate, Carbon $endDate)
	{
		$records = Attendance::where('user_id', $userId)
			->whereBetween('attendance_date', [$startDate->toDateString(), $endDate->toDateString()])
			->get(['attendance_status', 'attendance_date', 'check_in', 'check_out']);

		$summary = [
			'work_days' => 0,
			'work_hours' => 0,
			'absent_days' => 0,
			'leave_days' => 0,
		];

		foreach ($records as $record) {
			if ($record->attendance_status == 1) {
				$summary['work_days']++;
			} elseif ($record->attendance_status == 0) {
				$summary['absent_days']++;
			} else {
				$summary['leave_days']++;
			}

			if (!empty($record->check_in) && !empty($record->check_out)) {
				try {
					$checkIn = Carbon::parse($record->attendance_date . ' ' . $record->check_in);
					$checkOut = Carbon::parse($record->attendance_date . ' ' . $record->check_out);

					if ($checkOut->greaterThan($checkIn)) {
						$summary['work_hours'] += round($checkIn->floatDiffInHours($checkOut), 2);
					}
				} catch (\Exception $exception) {
					continue;
				}
			}
		}

		return $summary;
	}

	protected function transformSalaryForPeriod(?Payroll $payroll, array $attendanceSummary)
	{
		if (!$payroll) {
			return [
				'data' => null,
				'pay_basis' => 'monthly',
				'calculated_basic_salary' => 0,
			];
		}

		$payStructure = $payroll->pay_structure ?? 'monthly';
		$calculatedBasic = (float) $payroll->basic_salary;

		if ($payStructure === 'daily' && !empty($payroll->daily_rate)) {
			$calculatedBasic = round($payroll->daily_rate * ($attendanceSummary['work_days'] ?? 0), 2);
		} elseif ($payStructure === 'hourly' && !empty($payroll->hourly_rate)) {
			$calculatedBasic = round($payroll->hourly_rate * ($attendanceSummary['work_hours'] ?? 0), 2);
		}

		$payload = clone $payroll;
		$payload->basic_salary = $calculatedBasic;

		return [
			'data' => $payload->toArray(),
			'pay_basis' => $payStructure,
			'calculated_basic_salary' => $calculatedBasic,
		];
	}
}