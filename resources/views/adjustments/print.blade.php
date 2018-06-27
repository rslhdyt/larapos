@extends('layouts.prints.a4')

@section('main-content')
<h1 class="title">{{ config('app.name') }}</h1>
<h3 class="subtitle">Receipt <small>{{ $adjustment->code }}</small></h3>
<hr>

<address class="address">
</address>

<address class="date">
    <strong>Receiving Date:</strong>
    {{ $adjustment->created_at->format('d F Y') }}
</address>

<h4 class="mb-5"><strong>Items</strong></h4>
<div class="table-responsive">
    <table class="table table-condensed">
        <thead>
            <tr>
                <td><strong>#</strong></td>
                <td><strong>Product</strong></td>
                <td class="text-center"><strong>Adjustment</strong></td>
                <td class="text-center"><strong>Diff</strong></td>
            </tr>
        </thead>
        <tbody>
            @forelse($adjustment->items as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->product->name }}</td>
                    <td class="text-center">{{ $item->adjustment . ' ' . $item->uom }}</td>
                    <td class="text-center">{{ $item->diff . ' ' . $item->uom }}</td>
                </tr>
            @empty
                <tr class="table-info">
                    <td colspan="4" align="center">Receiving items empty.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection