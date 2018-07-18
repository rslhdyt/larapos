@extends('layouts.app')

@section('main-content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    {{ Breadcrumbs::render('products.create') }}

    <div class="row mb-5">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header">Create Product</div>
                <div class="card-body">
                    <form action="{{ route('products.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input name="name" value="{{ old('name') }}" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" placeholder="Product name">
                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="barcode">Barcode *</label>
                            <input name="barcode" value="{{ old('barcode') }}" type="text" class="form-control {{ $errors->has('barcode') ? 'is-invalid' : '' }}" id="barcode" placeholder="Product barcode">
                            <div class="invalid-feedback">{{ $errors->first('barcode') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input name="description" value="{{ old('description') }}" type="text" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description" placeholder="Product description">
                            <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="description">Unit of Measure *</label>
                            <select name="uom_id" class="form-control {{ $errors->has('uom_id') ? 'is-invalid' : '' }}">
                                <option value>Choose</option>
                                @foreach($unitOfMeasures as $unitOfMeasure)
                                    <option value="{{ $unitOfMeasure->id }}" {{ (old('uom_id') == $unitOfMeasure->id) ? 'selected' : '' }}>{{ $unitOfMeasure->abbreviation }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">{{ $errors->first('uom_id') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="minimal_stock">Minimal Stock *</label>
                            <input name="minimal_stock" value="{{ old('minimal_stock') }}" type="text" class="form-control {{ $errors->has('minimal_stock') ? 'is-invalid' : '' }}" id="minimal_stock" placeholder="Minimum stock">
                            <div class="invalid-feedback">{{ $errors->first('minimal_stock') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="cost_price">Cost Price *</label>
                            <input name="cost_price" value="{{ old('cost_price') }}" type="text" class="form-control {{ $errors->has('cost_price') ? 'is-invalid' : '' }}" id="cost_price" placeholder="Product cost price">
                            <div class="invalid-feedback">{{ $errors->first('cost_price') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="unit_price">Price *</label>
                            <input name="unit_price" value="{{ old('unit_price') }}" type="text" class="form-control {{ $errors->has('unit_price') ? 'is-invalid' : '' }}" id="unit_price" placeholder="Product unit price">
                            <div class="invalid-feedback">{{ $errors->first('unit_price') }}</div>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('products.index') }}" class="btn btn-link">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection