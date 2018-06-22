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
                            <label for="quantity">Quantity *</label>
                            <input name="quantity" value="{{ old('quantity') }}" type="text" class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" id="quantity" placeholder="Initial product quantity">
                            <div class="invalid-feedback">{{ $errors->first('quantity') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="price">Price *</label>
                            <input name="price" value="{{ old('price') }}" type="text" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" id="price" placeholder="Product price">
                            <div class="invalid-feedback">{{ $errors->first('price') }}</div>
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