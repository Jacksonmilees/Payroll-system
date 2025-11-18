@extends('administrator.master')
@section('title', __('PAYE Report'))
@section('main_content')
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ __('PAYE') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('PAYE') }}</a></li>
            <li class="active">{{ __('PAYE Reportsss') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('PAYE Report') }}</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
            <div id="printable_area" class="col-md-12 table-responsive">
                   <table  class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="10%">{{ __(' KRA PIN') }}</th>
                                <th>{{ __(' NAME') }}</th>
                                <th>{{ __(' BASIC SALARY') }}</th>
                                <th>{{ __(' GROSS SALARY') }}</th>
                                <th>{{ __(' GROSS PAY') }}</th>
                                <th>{{ __(' 30% OF THE NET PAY') }}</th>
                                <th>{{ __(' NSSF CONTRIBUTION') }}</th>
                                <th>{{ __(' HOUSE LEAVY RELIEF') }}</th>
                                <th>{{ __(' TAXABLE NET') }}</th>
                                <th>{{ __(' TAX BEFORE RELIEF') }}</th>
                                <th>{{ __(' TAX RELIEF') }}</th>
                                <th>{{ __(' SHIF RELIEF') }}</th>
                                <th>{{ __(' NET PAYE') }}</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @php $sl = 1; @endphp
                            @foreach($employees as $employee)
                            @php
                            // print_r($); exit;
                                $allowance = $employee['house_rent_allowance'] + $employee['medical_allowance'] + $employee['special_allowance'] + $employee['other_allowance'];
                                $gross_salary= $employee['basic_salary'] + $allowance;
                            @endphp
                            <tr>
                                <td>{{ $employee['kra_no'] }}</td>
                                <td>{{ $employee['name'].' '.$employee['mother_name'] . ' '. $employee['father_name'] }}</td>
                                <td>{{ $employee['basic_salary'] }}</td>
                                <td>{{ $gross_salary }}</td>
                                <td>{{ $gross_salary }}</td>
                                <td>{{ $gross_salary * 2.75 / 100 }}</td>
                                <td>{{ $nssf = $gross_salary <= 36000 ? $gross_salary * 6 / 100 : 2160 }}</td>
                                <td>{{$house_leavy_relief = ($gross_salary * 1.5 / 100) *15 /100 }}</td>
                                <td>{{ ($gross_salary - $nssf ) }}</td>
                                <td>{{ $employee['income_tax'] }}</td>
                                <td>{{ $employee['persnol_relief'] }}</td>
                                <td>{{ ($gross_salary * 2.75 / 100) * 15 / 100 }}</td>
                                <td>{{ $employee['paye']}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<script type="text/javascript">
//   function getNHIFRates(x) {
//     let nhif = 0;
//     if(between(x, 0, 5999))
//       nhif = 150;
//     else if(between(x, 6000, 8999))
//       nhif = 300;
//     else if(between(x, 8000, 11999))
//       nhif = 400;
//     else if(between(x, 12000, 14999))
//       nhif = 500;
//     else if(between(x, 15000,19999))
//       nhif = 600;
//     else if(between(x, 20000 ,24999))
//       nhif = 750;
//     else if(between(x, 25000 ,29999))
//       nhif = 850;
//     else if(between(x, 30000 ,34999))
//       nhif = 900;
//     else if(between(x, 35000 ,39000))
//       nhif = 950;
//     else if(between(x, 40000 ,44999))
//       nhif = 1000;
//     else if(between(x, 45000 ,49000))
//       nhif = 1100;
//     else if(between(x, 50000 ,59999))
//       nhif = 1200;
//     else if(between(x, 60000 ,69999))
//       nhif = 1300;
//     else if(between(x, 70000 ,79999))
//       nhif = 1400;
//     else if(between(x, 80000 ,89999))
//       nhif = 1500;
//     else if(between(x, 90000 ,99999))
//       nhif = 1600;
//     else if(x>100000)
//       nhif = 1700;
//     else 
//       nhif = 0;

//     return nhif;
//   }

   function getNHIFRates(x) {
        if(x > 0){
            return x * 2.75 / 100;// 2.75% of Gross Salary
        }
    }

//   function getNSSFRate (x) {
//     let NSSF = 0;
//     if(between(x, 0, 18000) ){
//       NSSF= x*6/100; //of Gross salary
//     }else if (x > 18000){
//       NSSF = 1080;
//     }
//     return NSSF;
//   }

  function getNSSFRate(x) {
      let nssf = 0;
      if (between(x, 0, 36000)) {
        nssf = x * 6 / 100; //of Gross salary
      } else if (x > 36000) {
        nssf = 2160;
      }
      return nssf;
    }
  
  function between(x, min, max) {
    return x >= min && x <= max;
  }
</script>
@endsection