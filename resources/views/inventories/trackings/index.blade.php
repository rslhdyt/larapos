@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Recievings</div>

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
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $tracking->user->name }}</td>
                                <td>{{ $tracking->product->name }}</td>

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
                        @include('partials.table-blank-slate', ['colspan' => 5])
                    @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection