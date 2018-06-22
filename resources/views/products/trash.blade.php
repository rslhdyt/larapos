@extends('layouts.app')

@section('main-content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    {{ Breadcrumbs::render('products.trash') }}

    <div class="row mb-5">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-body">
                    <form class="form-inline float-right">
                        <label class="sr-only" for="keyword">Keyword</label>
                        <input name="q" type="text" class="form-control mb-2 mr-sm-2" id="keyword" placeholder="Keyword" value="{{ Request::get('q') }}">

                        {{-- <label class="sr-only" for="uoms">Unit Of Measure</label>
                        <select name="uom_id" class="form-control mb-2 mr-sm-2" id="uoms">
                            <option value>Choose...</option>
                            @foreach($unitOfMeasures as $key => $unitOfMeasure)
                                <option value="{{ $unitOfMeasure->id }}">{{ $unitOfMeasure->abbreviation }}</option>
                            @endforeach
                        </select>

                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp</div>
                            </div>
                            <input name="price" type="text" class="form-control" id="price" placeholder="Price">
                            <select name="price_operator" class="custom-select" id="price-operator">
                                <option value="=">=</option>
                                <option value=">=">>=</option>
                                <option value="<="><=</option>
                            </select>
                        </div> --}}

                        <button type="submit" class="btn btn-primary mb-2">Search</button>
                        <a href="{{ route('products.trash') }}" class="btn btn-dark mb-2 ml-sm-2"><i class="fa fa-refresh"></i></a>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="pull-left mb-0 mt-2">
                        <i class="fa fa-table"></i> Trashed Products List
                    </div>
                    <div class="pull-right text-right">
                        <a href="{{ route('products.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Barcode</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Deleted At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $key => $product)
                                    <tr>
                                        <td>{{ $products->firstItem() + $key }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->barcode }}</td>
                                        <td>{{ currency($product->price) }}</td>
                                        <td>{{ $product->quantity . ' ' . $product->uom->abbreviation  }}</td>
                                        <td>{{ $product->deleted_at  }}</td>
                                        <td>
                                            <restore-action action="{{ route('api.products.restore', $product) }}" class="ml-2 text-warning">
                                                <i class="fa fa-recycle"></i>
                                            </delete-action>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="table-info">
                                        <td colspan="7" align="center">Products empty or not found.</td>
                                    <tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer small text-muted">
                    <p class="pull-left mb-0 mt-2">From {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} data </p>
                    {{ $products->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection