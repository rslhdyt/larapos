@extends('layouts.setting')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Permissions - Edit</div>

    <div class="panel-body">
        <form action="{{ url('settings/permissions/' . $permission->id) }}" method="POST">
            <input type="hidden" name="_method" value="put">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="object">Object</label>
                <input type="text" class="form-control" id="object" name="object" value="{{ old('object', $permission->object) }}">
            </div>

            <div class="form-group">
                <label for="action">Action</label>
                <input type="text" class="form-control" id="action" name="action" value="{{ old('action', $permission->action) }}">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
                <a class="btn btn-link" href="{{ url('settings/permissions') }}">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection