@extends('layouts.setting')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Roles - Edit</div>

    <div class="panel-body">
        <form action="{{ url('settings/roles/' . $role->id) }}" method="POST">
            <input type="hidden" name="_method" value="put">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $role->name) }}">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description">{{ old('description', $role->description) }}</textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
                <a class="btn btn-link" href="{{ url('settings/roles') }}">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection