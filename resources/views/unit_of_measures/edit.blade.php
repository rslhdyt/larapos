@extends('layouts.app')

@section('main-content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    {{ Breadcrumbs::render('unit-of-measures.edit', $unitOfMeasure) }}

    <div class="row mb-5">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header">Edit Unit of Measure</div>
                <div class="card-body">
                    <form action="{{ route('unit-of-measures.update', $unitOfMeasure) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input name="name" value="{{ old('name', $unitOfMeasure->name) }}" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" placeholder="Unit of measure name, eg (Pieces)">
                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="abbreviation">Abbreviation *</label>
                            <input name="abbreviation" value="{{ old('abbreviation', $unitOfMeasure->abbreviation) }}" type="text" class="form-control {{ $errors->has('abbreviation') ? 'is-invalid' : '' }}" id="abbreviation" placeholder="Unit of measure abbreviation, eg (PCS)">
                            <div class="invalid-feedback">{{ $errors->first('abbreviation') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input name="description" value="{{ old('description', $unitOfMeasure->description) }}" type="text" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description" placeholder="Description of unit of measure">
                            <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('unit-of-measures.index') }}" class="btn btn-link">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection