@extends('layouts.setting')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">General Settings</div>

    <div class="panel-body">
        <form action="{{ url('settings/general') }}" method="POST">
            <input type="hidden" name="_method" value="put">
            {{ csrf_field() }}

            @forelse($settings as $setting)
            <div class="form-group">
                <label for="object">{{ $setting->label }}</label>
                <input type="text" class="form-control" id="{{ $setting->key }}" name="{{ $setting->key }}" value="{{ old($setting->key, $setting->value) }}">
            </div>
            @empty
            @endforelse

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
                <a class="btn btn-link" href="{{ url('settings/general') }}">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection