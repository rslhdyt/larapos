@extends('layouts.prints.a4')

@section('main-content')
<h1 class="title">{{ config('app.name') }}</h1>
<h3 class="subtitle">Receipt <small>{{ $receiving->code }}</small></h3>
<hr>

<address class="address">
    <strong>From Supplier:</strong>
    {{ $receiving->supplier->name }}<br>
    {{ $receiving->supplier->address }}
</address>

<address class="date">
    <strong>Receiving Date:</strong>
    {{ $receiving->created_at->format('d F Y') }}
</address>

<h4 class="mb-5"><strong>Items</strong></h4>
<div class="table-responsive">
    <table class="table table-condensed">
        <thead>
            <tr>
                <td><strong>#</strong></td>
                <td><strong>Product</strong></td>
                <td class="text-center"><strong>Quantity</strong></td>
                <td class="text-right"><strong>Price</strong></td>
                <td class="text-right"><strong>Subtotal</strong></td>
            </tr>
        </thead>
        <tbody>
            @forelse($receiving->items as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->product->name }}</td>
                    <td class="text-center">{{ $item->quantity . ' ' . $item->product->uom->abbreviation }}</td>
                    <td class="text-right">{{ currency($item->price) }}</td>
                    <td class="text-right">{{ currency($item->subtotalPrice) }}</td>
                </tr>
            @empty
                <tr class="table-info">
                    <td colspan="5" align="center">Receiving items empty.</td>
                </tr>
            @endforelse

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td class="text-right"><strong>Total</strong></td>
                <td class="text-right">{{ currency($receiving->totalPrice) }}</td>
            </tr>
        </tbody>
    </table>
</div>

@endsection