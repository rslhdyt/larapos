@extends('layouts.app')

@section('content')
<?php $input['date_range'] = !empty($input['date_range']) ? $input['date_range'] : null; ?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Inventory Trackings</div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Product</th>
                            <th>In</th>
                            <th>Out</th>
                            <th>Remarks</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($trackings as $key => $tracking)
                        @if (!empty($tracking->trackable))
                            <tr>
                                <td>{{ $trackings->firstItem() + $key }}</td>
                                <td>{{ $tracking->user->name }}</td>
                                <td>{{ ($tracking->product) ? $tracking->product->name : 'PROD-'.$tracking->product_id }}</td>

                                    @if ($tracking->trackable_type == 'App\SaleItem')
                                        <td>-</td>
                                        <td>{{ $tracking->trackable->quantity }}</td>
                                        <td>Sales</td>
                                    @elseif ($tracking->trackable_type == 'App\ReceivingItem')
                                        <td>{{ $tracking->trackable->quantity }}</td>
                                        <td>-</td>
                                        <td>Receiving</td>
                                    @else
                                        @if ($tracking->trackable->diff > 0)
                                            <td>{{ $tracking->trackable->diff }}</td>
                                            <td>-</td>
                                        @else
                                            <td>-</td>
                                            <td>{{ abs($tracking->trackable->diff) }}</td>
                                        @endif
                                        <td>Adjustment</td>
                                    @endif

                                <td>{{ $tracking->created_at->format('d F Y H:i') }}</td>
                            </tr>
                        @endif
                    @empty
                        @include('partials.table-blank-slate', ['colspan' => 7])
                    @endforelse
                    </tbody>
                </table>

                <div class="panel-footer" style="text-align: right;">
                    {{ $trackings->links() }}
                </div> 
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Filter</div>
                <div class="panel-body">
                    <form action="{{ url('inventories/trackings') }}" method="GET">
                        <div class="form-group">
                            <label class="control-label">Product</label>
                            
                        </div>
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
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection