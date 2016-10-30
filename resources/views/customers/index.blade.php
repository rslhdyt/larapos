@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Customers
                    <div class="pull-right">
                        <a href="{{ url('customers/create') }}" class="btn btn-primary btn-xs">Create</a>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($customers as $key => $customer)
                        <tr>
                            <td>{{ $customers->firstItem() + $key }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>
                                <form id="delete-customer" action="{{ url('customers/' . $customer->id) }}" method="POST" class="form-inline">
                                    <input type="hidden" name="_method" value="delete">
                                    {{ csrf_field() }}
                                    <input type="submit" value="Delete" class="btn btn-danger btn-xs pull-right btn-delete">
                                </form>
                                <a href="{{ url('customers/' . $customer->id . '/edit') }}" class="btn btn-primary btn-xs pull-right">Edit</a>
                            </td>
                        </tr>
                    @empty
                        @include('partials.table-blank-slate', ['colspan' => 5])
                    @endforelse
                    </tbody>
                </table>

                <div class="panel-footer" style="text-align: right;">
                    {{ $customers->links() }}
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection