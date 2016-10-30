@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Suppliers
                    <div class="pull-right">
                        <a href="{{ url('suppliers/create') }}" class="btn btn-primary btn-xs">Create</a>
                    </div>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Company Name</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th width="170"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($suppliers as $key => $supplier)
                        <tr>
                            <td>{{ $suppliers->firstItem() + $key }}</td>
                            <td>{{ $supplier->company_name }}</td>
                            <td>{{ $supplier->name }}</td>
                            <td>{{ $supplier->email }}</td>
                            <td>{{ $supplier->phone }}</td>
                            <td>
                                <form id="delete-supplier" action="{{ url('suppliers/' . $supplier->id) }}" method="POST" class="form-inline">
                                    <input type="hidden" name="_method" value="delete">
                                    {{ csrf_field() }}
                                    <input type="submit" value="Delete" class="btn btn-danger btn-xs pull-right btn-delete">
                                </form>
                                <a href="{{ url('suppliers/' . $supplier->id . '/edit') }}" class="btn btn-primary btn-xs pull-right">Edit</a>
                            </td>
                        </tr>
                    @empty
                        @include('partials.table-blank-slate', ['colspan' => 6])
                    @endforelse
                    </tbody>
                </table>

                <div class="panel-footer" style="text-align: right;">
                    {{ $suppliers->links() }}
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection