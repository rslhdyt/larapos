@extends('layouts.setting')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Permissions
        <div class="pull-right">
            <a href="{{ url('settings/permissions/create') }}" class="btn btn-primary btn-xs">Create</a>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Auth Name</th>
                <th>Object</th>
                <th>Action</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @forelse ($permissions as $key => $permission)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $permission->name }}</td>
                <td>{{ $permission->object }}</td>
                <td>{{ $permission->action }}</td>
                <td>
                    <form id="delete-permission" action="{{ url('settings/permissions/' . $permission->id) }}" method="POST" class="form-inline">
                        <input type="hidden" name="_method" value="delete">
                        {{ csrf_field() }}
                        <input type="submit" value="Delete" class="btn btn-danger btn-xs pull-right btn-delete">
                    </form>
                    <a href="{{ url('settings/permissions/' . $permission->id . '/edit') }}" class="btn btn-primary btn-xs pull-right">Edit</a>
                </td>
            </tr>
        @empty
            @include('partials.table-blank-slate', ['colspan' => 4])
        @endforelse
        </tbody>
    </table>

</div>
@endsection