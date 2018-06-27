@extends('layouts.app')

@section('main-content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    {{ Breadcrumbs::render('receivings.edit', $receiving) }}

    <div class="row mb-5">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header">Edit Receiving</div>
                <div class="card-body">
                    <form action="{{ route('receivings.update', $receiving) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="supplier_id">Supplier *</label>
                            <select name="supplier_id" class="form-control {{ $errors->has('supplier_id') ? 'is-invalid' : '' }}">
                                <option value>Choose</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ (old('supplier_id', $receiving->supplier_id) == $supplier->id) ? 'selected' : '' }}>{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">{{ $errors->first('supplier_id') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="comments">Comments</label>
                            <textarea name="comments" class="form-control {{ $errors->has('comments') ? 'is-invalid' : '' }}" id="comments">{{ old('comments', $receiving->comments) }}</textarea>
                            <div class="invalid-feedback">{{ $errors->first('comments') }}</div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('receivings.index') }}" class="btn btn-link">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection