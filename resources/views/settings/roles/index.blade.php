@extends('layouts.setting')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Roles
        <div class="pull-right">
            <a href="{{ url('settings/roles/create') }}" class="btn btn-primary btn-xs">Create</a>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Total Member</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @forelse ($roles as $key => $role)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->description }}</td>
                <td>{{ $role->users->count() }}</td>
                <td>
                    <form id="delete-role" action="{{ url('settings/roles/' . $role->id) }}" method="POST" class="form-inline">
                        <input type="hidden" name="_method" value="delete">
                        {{ csrf_field() }}
                        <input type="submit" value="Delete" class="btn btn-danger btn-xs pull-right btn-delete">
                    </form>
                    <a href="{{ url('settings/roles/' . $role->id . '/edit') }}" class="btn btn-primary btn-xs pull-right">Edit</a>
                </td>
            </tr>
        @empty
            @include('partials.table-blank-slate', ['colspan' => 3])
        @endforelse
        </tbody>
    </table>

</div>
@endsection