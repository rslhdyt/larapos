@extends('layouts.app')

@section('main-content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    {{ Breadcrumbs::render('adjustments.edit', $adjustment) }}

    <div class="row mb-5">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header">Edit Adjustment</div>
                <div class="card-body">
                    <form action="{{ route('adjustments.update', $adjustment) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="comments">Comments</label>
                            <textarea name="comments" class="form-control {{ $errors->has('comments') ? 'is-invalid' : '' }}" id="comments">{{ old('comments', $adjustment->comments) }}</textarea>
                            <div class="invalid-feedback">{{ $errors->first('comments') }}</div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('adjustments.index') }}" class="btn btn-link">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection