@extends('layouts.app')

@section('main-content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    {{ Breadcrumbs::render('customers.create') }}

    <div class="row mb-5">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header">Create Customer</div>
                <div class="card-body">
                    <form action="{{ route('customers.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input name="name" value="{{ old('name') }}" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" placeholder="Customer name">
                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input name="email" value="{{ old('email') }}" type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" placeholder="Customer email">
                            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number *</label>
                            <input name="phone" value="{{ old('phone') }}" type="text" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" id="phone" placeholder="Customer phone number">
                            <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="address">Adress</label>
                            <input name="address" value="{{ old('address') }}" type="text" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" id="address" placeholder="Customer address">
                            <div class="invalid-feedback">{{ $errors->first('address') }}</div>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('customers.index') }}" class="btn btn-link">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection