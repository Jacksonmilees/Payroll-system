@extends('administrator.master')
@section('title', __('Salary Reports'))

@section('main_content')
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
  <section class="content-header">
    <h1>{{ __('Salary Reports') }}</h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
      <li><a>{{ __('Reports') }}</a></li>
      <li class="active">{{ __('Salary') }}</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">{{ __('Filters') }}</h3>
          </div>
          <div class="box-body">
            <form class="form-horizontal" method="get" action="{{ route('reports.salary') }}">
              <div class="form-group">
                <label for="from_date" class="col-sm-2 control-label">{{ __('From Date') }}</label>
                <div class="col-sm-4">
                  <input type="date" name="from_date" id="from_date" class="form-control" value="{{ $filters['from_date'] }}">
                </div>
                <label for="to_date" class="col-sm-2 control-label">{{ __('To Date') }}</label>
                <div class="col-sm-4">
                  <input type="date" name="to_date" id="to_date" class="form-control" value="{{ $filters['to_date'] }}">
                </div>
              </div>
              <div class="form-group">
                <label for="user_id" class="col-sm-2 control-label">{{ __('Employee') }}</label>
                <div class="col-sm-4">
                  <select name="user_id" id="user_id" class="form-control">
                    <option value="">{{ __('All Employees') }}</option>
                    @foreach($employees as $employee)
                      <option value="{{ $employee->id }}" {{ $filters['user_id'] == $employee->id ? 'selected' : '' }}>
                        {{ (!empty($employee->name_prefix) ? $employee->name_prefix.' - ' : '') . $employee->name }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <label for="pay_basis" class="col-sm-2 control-label">{{ __('Pay Basis') }}</label>
                <div class="col-sm-4">
                  <select name="pay_basis" id="pay_basis" class="form-control">
                    <option value="">{{ __('All') }}</option>
                    <option value="monthly" {{ $filters['pay_basis'] === 'monthly' ? 'selected' : '' }}>{{ __('Monthly') }}</option>
                    <option value="daily" {{ $filters['pay_basis'] === 'daily' ? 'selected' : '' }}>{{ __('Daily') }}</option>
                    <option value="hourly" {{ $filters['pay_basis'] === 'hourly' ? 'selected' : '' }}>{{ __('Hourly') }}</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="frequency" class="col-sm-2 control-label">{{ __('Group By') }}</label>
                <div class="col-sm-4">
                  <select name="frequency" id="frequency" class="form-control">
                    <option value="daily" {{ $filters['frequency'] === 'daily' ? 'selected' : '' }}>{{ __('Daily') }}</option>
                    <option value="monthly" {{ $filters['frequency'] === 'monthly' ? 'selected' : '' }}>{{ __('Monthly') }}</option>
                  </select>
                </div>
                <div class="col-sm-6 text-right">
                  <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-filter"></i> {{ __('Apply') }}</button>
                  <a href="{{ route('reports.salary') }}" class="btn btn-default btn-flat">{{ __('Reset') }}</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-md-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">{{ __('Summary') }}</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-3 col-sm-6">
                <div class="info-box bg-aqua">
                  <span class="info-box-icon"><i class="fa fa-money"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">{{ __('Total Paid') }}</span>
                    <span class="info-box-number">{{ number_format($summary['total_paid'], 2) }}</span>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="info-box bg-green">
                  <span class="info-box-icon"><i class="fa fa-calendar-check-o"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">{{ __('Worked Days') }}</span>
                    <span class="info-box-number">{{ $summary['total_work_days'] }}</span>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="info-box bg-yellow">
                  <span class="info-box-icon"><i class="fa fa-clock-o"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">{{ __('Worked Hours') }}</span>
                    <span class="info-box-number">{{ number_format($summary['total_work_hours'], 2) }}</span>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="info-box bg-red">
                  <span class="info-box-icon"><i class="fa fa-users"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">{{ __('Payments') }}</span>
                    <span class="info-box-number">{{ $summary['count'] }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">{{ __('Grouped Overview') }}</h3>
          </div>
          <div class="box-body table-responsive">
            <table class="table table-bordered">
              <tr class="bg-info">
                <th>{{ __('Period') }}</th>
                <th>{{ __('Amount') }}</th>
                <th>{{ __('Work Days') }}</th>
                <th>{{ __('Work Hours') }}</th>
              </tr>
              @forelse($grouped as $period => $data)
                <tr>
                  <td>{{ $period }}</td>
                  <td>{{ number_format($data['amount'], 2) }}</td>
                  <td>{{ $data['work_days'] }}</td>
                  <td>{{ number_format($data['work_hours'], 2) }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" class="text-center text-muted">{{ __('No data available for the selected filters.') }}</td>
                </tr>
              @endforelse
            </table>
          </div>
        </div>
      </div>

      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">{{ __('Detailed Payments') }}</h3>
          </div>
          <div class="box-body table-responsive">
            <table class="table table-bordered table-striped">
              <tr class="bg-info">
                <th>{{ __('Date') }}</th>
                <th>{{ __('Employee') }}</th>
                <th>{{ __('Pay Basis') }}</th>
                <th>{{ __('Work Days') }}</th>
                <th>{{ __('Work Hours') }}</th>
                <th>{{ __('Amount') }}</th>
                <th>{{ __('Payment Type') }}</th>
                <th>{{ __('Notes') }}</th>
              </tr>
              @forelse($payments as $payment)
                <tr>
                  <td>{{ $payment->payment_date ?? $payment->payment_month }}</td>
                  <td>
                    {{ $payment->user ? ((!empty($payment->user->name_prefix) ? $payment->user->name_prefix.' - ' : '') . $payment->user->name) : __('Unknown') }}
                  </td>
                  <td>{{ ucfirst($payment->pay_basis ?? 'monthly') }}</td>
                  <td>{{ $payment->work_days }}</td>
                  <td>{{ number_format($payment->work_hours, 2) }}</td>
                  <td>{{ number_format($payment->payment_amount, 2) }}</td>
                  <td>
                    @if($payment->payment_type == 1)
                      {{ __('Cash') }}
                    @elseif($payment->payment_type == 2)
                      {{ __('Cheque') }}
                    @else
                      {{ __('Bank') }}
                    @endif
                  </td>
                  <td>{{ $payment->note }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="8" class="text-center text-muted">{{ __('No salary payments found.') }}</td>
                </tr>
              @endforelse
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

