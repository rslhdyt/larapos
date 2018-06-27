@extends('layouts.app')

@section('main-content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    {{ Breadcrumbs::render('receivings.show', $receiving) }}

    <div class="row mb-5">
        <div class="col-md-8 col-sm-12">
            <div class="card mb-3">
                <div class="card-header">Receiving Items</div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th width="10%">#</th>
                                    <th>Product</th>
                                    <th width="20%">Quantity</th>
                                    <th width="20%">Price</th>
                                    <th width="20%">Subtotal Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($receiving->items as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->quantity . ' ' . $item->product->uom->abbreviation }}</td>
                                        <td>{{ currency($item->price) }}</td>
                                        <td>{{ currency($item->subtotalPrice) }}</td>
                                    </tr>
                                @empty
                                    <tr class="table-info">
                                        <td colspan="5" align="center">Receiving items empty.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer small text-muted">
                    Total Item : {{ $receiving->items->count() }}
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="card mb-3">
                <div class="card-header">Receiving Data</div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="supplier">Supplier</label>
                        <input type="text" readonly class="form-control-plaintext" id="supplier" value="{{ $receiving->supplier->name }}">
                    </div>
                    <div class="form-group">
                        <label for="user">Created By</label>
                        <input type="text" readonly class="form-control-plaintext" id="user" value="{{ $receiving->user->name }}">
                    </div>
                    <div class="form-group">
                        <label for="created_at">Created At</label>
                        <input type="text" readonly class="form-control-plaintext" id="created_at" value="{{ $receiving->created_at }}">
                    </div>
                    <div class="form-group">
                        <label for="comments">Comments</label>
                        <input type="text" readonly class="form-control-plaintext" id="supplier" value="{{ $receiving->comments }}">
                    </div>

                    <a href="{{ route('receivings.print', $receiving) }}" class="btn btn-info"><i class="fa fa-print"></i> Print</a>
                    <a href="{{ route('receivings.index') }}" class="btn btn-light">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection