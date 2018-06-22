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
                            <label for="price">Price *</label>
                            <input name="price" value="{{ old('price', $product->price) }}" type="text" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" id="price" placeholder="Product price">
                            <div class="invalid-feedback">{{ $errors->first('price') }}</div>
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