<?php

namespace App\Http\Controllers;

use App\SalaryPayment;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
	public function salary(Request $request)
	{
		$defaultStart = Carbon::now()->startOfMonth()->toDateString();
		$defaultEnd = Carbon::now()->endOfMonth()->toDateString();

		$filters = [
			'from_date' => $request->get('from_date', $defaultStart),
			'to_date' => $request->get('to_date', $defaultEnd),
			'user_id' => $request->get('user_id'),
			'pay_basis' => $request->get('pay_basis'),
			'frequency' => $request->get('frequency', 'monthly'),
		];

		$query = SalaryPayment::with(['user' => function ($query) {
			$query->select('id', 'name', 'name_prefix', 'employee_id');
		}]);

		if (!empty($filters['from_date'])) {
			$query->whereDate('payment_date', '>=', $filters['from_date']);
		}

		if (!empty($filters['to_date'])) {
			$query->whereDate('payment_date', '<=', $filters['to_date']);
		}

		if (!empty($filters['user_id'])) {
			$query->where('user_id', $filters['user_id']);
		}

		if (!empty($filters['pay_basis'])) {
			$query->where('pay_basis', $filters['pay_basis']);
		}

		$payments = $query->orderBy('payment_date', 'desc')
			->orderBy('payment_month', 'desc')
			->get();

		$summary = [
			'total_paid' => $payments->sum('payment_amount'),
			'total_work_days' => $payments->sum('work_days'),
			'total_work_hours' => $payments->sum('work_hours'),
			'count' => $payments->count(),
		];

		$grouped = $payments->groupBy(function ($payment) use ($filters) {
			$reference = $payment->payment_date ?? $payment->payment_month;
			$format = $filters['frequency'] === 'daily' ? 'Y-m-d' : 'Y-m';

			return Carbon::parse($reference)->format($format);
		})->map(function ($items) {
			return [
				'work_days' => $items->sum('work_days'),
				'work_hours' => $items->sum('work_hours'),
				'amount' => $items->sum('payment_amount'),
			];
		});

		$employees = User::whereBetween('access_label', [2, 3])
			->where('deletion_status', 0)
			->orderBy('name')
			->get(['id', 'name', 'name_prefix']);

		return view('administrator.hrm.reports.salary_reports', compact('payments', 'employees', 'filters', 'summary', 'grouped'));
	}
}


