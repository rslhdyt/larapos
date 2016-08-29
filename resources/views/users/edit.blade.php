@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Users - Edit</div>

                <div class="panel-body">
                    <form action="{{ url('users/' . $user->id) }}" method="POST">
                        <input type="hidden" name="_method" value="put">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
                        </div>

                        <div class="form-group">
                            <label for="role_id">Role</label>
                            <select class="form-control" id="role_id" name="role_id">
                                @foreach($roles as $id => $role)
                                    <option value="{{ $id }}" {{ !($id == old('role_id', $user->role_id)) ?: 'selected="selected"' }} >{{ $role }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a class="btn btn-link" href="{{ url('users') }}">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection