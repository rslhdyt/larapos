@extends('layouts.setting')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Permissions - Create</div>

    <div class="panel-body">
        <form action="{{ url('settings/permissions') }}" method="POST">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="object">Object</label>
                <input type="text" class="form-control" id="object" name="object" value="{{ old('object') }}">
            </div>

            <div class="form-group">
                <label for="action">Action</label>
                <input type="text" class="form-control" id="action" name="action" value="{{ old('action') }}">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
                <a class="btn btn-link" href="{{ url('settings/permissions') }}">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection