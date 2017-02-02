@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Recievings
                    <div class="pull-right">
                        <a href="{{ url('inventories/receivings/create') }}" class="btn btn-primary btn-xs">Create</a>
                    </div>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Supplier</th>
                            <th>Total Item</th>
                            <th>Total Amount</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($receivings as $key => $receiving)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ ($receiving->supplier) ? $receiving->supplier->name : 'SUP-'.$receiving->supplier_id }}</td>
                            <td>{{ $receiving->total_item }}</td>
                            <td>{{ $receiving->total_amount }}</td>
                            <td>{{ $receiving->created_at->format('d F Y H:i') }}</td>
                        </tr>
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