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
                            <th>{{ $key + 1 }}</th>
                            <th>{{ $customer->name }}</th>
                            <th>{{ $customer->email }}</th>
                            <th>{{ $customer->phone }}</th>
                            <th>
                                <form id="delete-customer" action="{{ url('customers/' . $customer->id) }}" method="POST" class="form-inline">
                                    <input type="hidden" name="_method" value="delete">
                                    {{ csrf_field() }}
                                    <input type="submit" value="Delete" class="btn btn-danger btn-xs pull-right btn-delete">
                                </form>
                                <a href="{{ url('customers/' . $customer->id . '/edit') }}" class="btn btn-primary btn-xs pull-right">Edit</a>
                            </th>
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