@extends('layouts.app')

@section('main-content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    {{ Breadcrumbs::render('products.edit', $product) }}

    <div class="row mb-5">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header">Edit Product</div>
                <div class="card-body">
                    <form action="{{ route('products.update', $product) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input name="name" value="{{ old('name', $product->name) }}" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" placeholder="Product name">
                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="barcode">Barcode *</label>
                            <input name="barcode" value="{{ old('barcode', $product->barcode) }}" type="text" class="form-control {{ $errors->has('barcode') ? 'is-invalid' : '' }}" id="barcode" placeholder="Product barcode">
                            <div class="invalid-feedback">{{ $errors->first('barcode') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input name="description" value="{{ old('description', $product->description) }}" type="text" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description" placeholder="Product description">
                            <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="description">Unit of Measure *</label>
                            <select name="uom_id" class="form-control {{ $errors->has('uom_id') ? 'is-invalid' : '' }}">
                                <option value>Choose</option>
                                @foreach($unitOfMeasures as $unitOfMeasure)
                                    <option value="{{ $unitOfMeasure->id }}" {{ (old('uom_id', $product->uom_id) == $unitOfMeasure->id) ? 'selected' : '' }}>{{ $unitOfMeasure->abbreviation }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">{{ $errors->first('uom_id') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="cost_price">Cost Price *</label>
                            <input name="cost_price" value="{{ old('cost_price', $product->cost_price) }}" type="text" class="form-control {{ $errors->has('cost_price') ? 'is-invalid' : '' }}" id="cost-price" placeholder="Product cost price">
                            <div class="invalid-feedback">{{ $errors->first('cost_price') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="unit_price">Unit Price *</label>
                            <input name="unit_price" value="{{ old('unit_price', $product->unit_price) }}" type="text" class="form-control {{ $errors->has('unit_price') ? 'is-invalid' : '' }}" id="unit-price" placeholder="Product unit price">
                            <div class="invalid-feedback">{{ $errors->first('unit_price') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="minimal_stock">Minimal Stock *</label>
                            <input name="minimal_stock" value="{{ old('minimal_stock', $product->minimal_stock) }}" type="text" class="form-control {{ $errors->has('minimal_stock') ? 'is-invalid' : '' }}" id="minimal_stock" placeholder="Product minimum stock">
                            <div class="invalid-feedback">{{ $errors->first('minimal_stock') }}</div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('products.index') }}" class="btn btn-link">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection