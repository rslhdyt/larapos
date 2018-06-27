@extends('layouts.app')

@section('main-content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    {{ Breadcrumbs::render('adjustments.show', $adjustment) }}

    <div class="row mb-5">
        <div class="col-md-8 col-sm-12">
            <div class="card mb-3">
                <div class="card-header">Adjustment Items</div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th width="10%">#</th>
                                    <th>Product</th>
                                    <th width="20%">Adjustment</th>
                                    <th width="20%">Diff</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($adjustment->items as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->adjustment . ' ' . $item->uom }}</td>
                                        <td>{{ $item->diff . ' ' . $item->uom }}</td>
                                    </tr>
                                @empty
                                    <tr class="table-info">
                                        <td colspan="4" align="center">Adjustment items empty.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer small text-muted">
                    Total Item : {{ $adjustment->items->count() }}
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="card mb-3">
                <div class="card-header">Adjustment Data</div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="user">Created By</label>
                        <input type="text" readonly class="form-control-plaintext" id="user" value="{{ $adjustment->user->name }}">
                    </div>
                    <div class="form-group">
                        <label for="created_at">Created At</label>
                        <input type="text" readonly class="form-control-plaintext" id="created_at" value="{{ $adjustment->created_at }}">
                    </div>
                    <div class="form-group">
                        <label for="comments">Comments</label>
                        <input type="text" readonly class="form-control-plaintext" id="supplier" value="{{ $adjustment->comments }}">
                    </div>

                    <a href="{{ route('adjustments.print', $adjustment) }}" class="btn btn-info"><i class="fa fa-print"></i> Print</a>
                    <a href="{{ route('adjustments.index') }}" class="btn btn-light">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection