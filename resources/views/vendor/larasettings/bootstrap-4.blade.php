@extends('layouts.app')

@section('main-content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    {{ Breadcrumbs::render('unit-of-measures.create') }}

    <div class="row mb-5">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header">Create Unit of Measure</div>
                <div class="card-body">
                    <form action="{{ route('settings.update') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        @foreach($settings as $setting)
                            <div class="form-group">
                                <label for="{{ $idAttr = str_slug($setting->label) }}">{{ $setting->label }}</label>
                                <input name="{{ $setting->key }}"type="text" class="form-control" id="{{ $idAttr }}" value="{{ old($setting->key, $setting->value) }}">
                            </div>
                        @endforeach

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection