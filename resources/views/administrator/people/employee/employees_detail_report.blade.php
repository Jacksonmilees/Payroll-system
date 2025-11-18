@extends('administrator.master')
@section('title', __(date('F Y',strtotime(request()->date ?? date('F Y')))  .' DETAILED PAYROLL REPORT'))
@section('main_content')
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        {{ __('Employees Detailed Report') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('Employee') }}</a></li>
            <li class="active">{{ __('Employees Detailed Report') }}</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Salary List') }}</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                 <div class="col-md-6">
                    <div class="my-2">
                        <form action="{{ URL::current(); }}" method="GET">
                            <div class="mb-3" style="display: flex;">
                                <input type="date" class="form-control" style="margin-top: 10px;" name="date" value="{{ request()->date ?? '' }}">
                                <button class="btn btn-primary" style="margin: 10px;" type="submit">GET</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- /.Notification Box -->
                <div id="printable_area" class="col-md-12 table-responsive">
                    <table  class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('Full Name') }}</th>
                                <th>{{ __(' B. SALARY') }}</th>
                                <th>{{ __(' T. ALLOWANCES') }}</th>
                                <th>{{ __(' PAYE') }}</th>
                                <th>{{ __(' NSSF') }}</th>
                                <th>{{ __(' SHIF') }}</th>
                                <th>{{ __(' Loans') }}</th>
                                <th>{{ __(' Advance Salary') }}</th>
                                <th>{{ __(' House Levy') }}</th>
                                <th>{{ __('OTHER DEDUCTIONS') }}</th>
                                <th>{{ __(' GROSS PAY') }}</th>
                                <th>{{ __(' T.DEDS') }}</th>
                                <th>{{ __(' NET SALARY') }}</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @php
                            $sl = 1;
                            $totalBasicSalary = 0;
                            $tAllowance = 0;
                            $totalPaye = 0;
                            $totalNssf = 0;
                            $totalNhif = 0;
                            $totalloan = 0;
                            $totalGrossPay = 0;
                            $totalDeduction = 0;
                            $totaladvance = 0;
                            $totalhouseleavy = 0;
                            $totalotherd = 0;
                            $totalNetSalary = 0;
                            @endphp
                            
                            @foreach($employees as $employee)
                            @php($debits = 0)
                            @php($credits = 0)
                            @php($al = 0)
                            @php($loanAmm = 0)
                            @php($specLoan = 0)
                            @php($advance = 0)
                            @php($houseleavy = 0)
                            @php($otherd = 0)
                            @php($credits += ($employee['house_rent_allowance'] + $employee['medical_allowance'] + $employee['special_allowance'] + $employee['other_allowance']))
                            @php($debits += $employee['tax_deduction'] + $employee['provident_fund_deduction'] + $employee['other_deduction'] + $employee['nhif'] + $employee['nssf'])
                            @php($debits += $employee['paye'])
                            @php($houseleavy += ($employee['basic_salary'] * 1.5)/100)
                            @foreach($bonuses as $bonus)
                                @if($employee['user_id'] == $bonus['user_id'])
                                    @php($credits += $bonus['bonus_amount'])
                                @endif
                            @endforeach

                            @foreach($deductions as $deduction)
                                @if($employee['user_id'] == $deduction['user_id'])
                                    @php($debits += $deduction['deduction_amount'])
                                    @if($deduction['deduction_name'] == 'advance')
                                        @php($advance += $deduction['deduction_amount'])
                                    @endif
                                    
                                     @if($deduction['deduction_name'] != 'advance' && $deduction['deduction_name'] != 'loan')
                                        @php($otherd += $deduction['deduction_amount'])
                                    @endif
                                @endif
                            @endforeach
                            @foreach($allowances as $allowance)
                                @if($employee['user_id'] == $allowance['user_id'])
                                    @php($credits += $allowance['deduction_amount'])
                                @endif
                            @endforeach

                            @foreach($loans as $loan)
                                @if($employee['user_id'] == $loan['user_id'])
                                    @php($installment = $loan['loan_amount'] / $loan['remaining_installments'])
                                    @php($loanAmm += $installment)
                                    @php($specLoan = $loan['loan_amount'])
                                    @php($remaining = $loan['remaining_installments'])
                                @endif
                            @endforeach
                            <tr>
                                <td>{{ $employee['name'].' '.$employee['mother_name'] .' '.$employee['father_name'] }}</td>
                                {{-- FOR TOTAL BASIC SALARY --}}
                                @php($totalBasicSalary += $employee['basic_salary'])
                                <td>{{ number_format ($employee['basic_salary'], 2, '.', ',') }}</td>
                                {{-- FOR TOTAL ALL ALLOWANCE --}}
                                @php($tAllowance += $credits)
                                <td>{{ number_format ($credits, 2, '.', ',') }}</td>
                                {{-- FOR TOTAL ALL PAYE --}}
                                @php($totalPaye += $employee['paye'])
                                <td>{{ number_format ($employee['paye'], 2, '.', ',') }}</td>
                                {{-- FOR TOTAL ALL NSSF --}}
                                @php($totalNssf += $employee['basic_salary'] <= 36000 ? $employee['basic_salary'] * 6 / 100 : 2160)
                                <td>{{ number_format ( $employee['basic_salary'] <= 36000 ? $employee['basic_salary'] * 6 / 100 : 2160, 2, '.', ',') }}</td>
                                {{-- FOR TOTAL ALL NHIF --}}
                                @php($totalNhif +=  $employee['basic_salary'] * 1.5 / 100)
                                <td>{{ number_format ($employee['basic_salary'] * 2.75 / 100, 2, '.', ',') }}</td>
                                
                                @php ($totalloan += $specLoan / ($remaining ?? 1))
                                @php($loanDevideByinstallments = $specLoan / ($remaining ?? 1))
                                <td>{{ number_format ($loanDevideByinstallments, 2, '.', ',') }}</td>
                                
                                @php($totaladvance += $advance)
                                <td>{{ number_format ($advance, 2, '.', ',') }}</td>
                            
                                {{-- FOR HOUSE LEVY AMOUNT (1.5% of Gross Pay) --}}
                                @php($houseLevy = ($employee['basic_salary']) * 1.5 / 100)
                                @php($totalhouseleavy += $houseLevy)
                                <td>{{ number_format($houseLevy, 2, '.', ',') }}</td>
                                @php($totalotherd+= $otherd)
                                <td>{{ number_format($otherd, 2, '.', ',') }}</td>
                                
                                {{-- FOR TOTAL ALL GROSS PAY --}}
                                @php($totalGrossPay += $credits+$employee['basic_salary'])
                                <td>{{ number_format ($credits+$employee['basic_salary'], 2, '.', ',') }}</td>
                                {{-- FOR TOTAL ALL LOAN AMOUT --}}
                                @php($totalDeduction += ($employee['paye'] + $loanDevideByinstallments + $employee['nssf'] + $employee['nhif'] + $advance + $houseLevy + $otherd))
                                <td>{{ number_format (($employee['paye'] +  + $employee['nssf'] + $employee['nhif'] +$loanAmm + $advance + $houseLevy  + $otherd ), 2, '.', ',') }}</td>
                                {{-- FOR TOTAL ALL NET PAY --}}
                                @php($totalNetSalary += ($credits+$employee['basic_salary'])-($employee['paye'] + $loanDevideByinstallments  + $employee['nssf'] + $employee['nhif']  + $advance + $houseleavy+ $otherd) )
                                <td>{{ number_format (($credits+$employee['basic_salary'])-($employee['paye'] + $loanDevideByinstallments  +$employee['nssf'] + $employee['nhif']  + $advance + $houseleavy+ $otherd), 2, '.', ',') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Total</td>
                                <td>{{ 'KES '.number_format($totalBasicSalary,2,'.',',') }}</td>
                                <td>{{ 'KES '.number_format($tAllowance,2,'.',',') }}</td>
                                <td>{{ 'KES '.number_format($totalPaye,2,'.',',') }}</td>
                                <td>{{ 'KES '.number_format($totalNssf,2,'.',',') }}</td>
                                <td>{{ 'KES '.number_format($totalNhif,2,'.',',') }}</td>
                                <td>{{ 'KES '.number_format($totalloan,2,'.',',') }}</td>
                                <td>{{ 'KES '.number_format($totaladvance,2,'.',',') }}</td>
                                <td>{{ 'KES '.number_format($totalhouseleavy,2,'.',',') }}</td>
                                <td>{{ 'KES '.number_format($totalotherd,2,'.',',') }}</td>
                                <td>{{ 'KES '.number_format($totalGrossPay,2,'.',',') }}</td>
                                <td>{{ 'KES '.number_format($totalDeduction,2,'.',',') }}</td>
                                <td>{{ 'KES '.number_format($totalNetSalary,2,'.',',') }}</td>  
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
@endsection