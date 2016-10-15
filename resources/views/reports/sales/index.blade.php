@extends('layouts.app')

@section('content')
<?php $input['date_range'] = !empty($input['date_range']) ? $input['date_range'] : null; ?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Sales Report</div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cashier</th>
                            <th>Customer</th>
                            <th>Sales Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @if (!empty($sales))
                        @forelse ($sales as $key => $sale)
                            <tr>
                                <th>{{ $key + 1 }}</th>
                                <th>{{ $sale->cashier->name }}</th>
                                <th>{{ $sale->customer->name }}</th>
                                <th>{{ $sale->created_at->format('d F Y') }}</th>
                                <th>
                                    <a href="{{ url('reports/sales/' . $sale->id) }}" class="btn btn-primary btn-xs pull-right">Show</a>
                                </th>
                            </tr>
                        @empty
                            @include('partials.table-blank-slate', ['colspan' => 5])
                        @endforelse
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Sales Report</div>

                <div class="panel-body">
                    <form action="{{ url('reports/sales') }}" method="GET">
                        <div class="form-group">
                            <label for="price">Date Range</label>
                            <select class="form-control" id="date-range" name="date_range">
                                <option>-- Select Date Range --</option>
                                <option value="today" {{ ($input['date_range'] == 'today') ? 'selected="selected"' : '' }}>Today</option>
                                <option value="current_week" {{ ($input['date_range'] == 'current_week') ? 'selected="selected"' : '' }}>This Week</option>
                                <option value="current_month" {{ ($input['date_range'] == 'current_month') ? 'selected="selected"' : '' }}>This Month</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection