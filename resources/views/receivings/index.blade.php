@extends('layouts.app')

@section('main-content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    {{ Breadcrumbs::render('receivings.index') }}

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
                            @foreach($receivings as $key => $receiving)
                                <option value="{{ $receiving->id }}">{{ $receiving->abbreviation }}</option>
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
                        <a href="{{ route('receivings.index') }}" class="btn btn-dark mb-2 ml-sm-2"><i class="fa fa-refresh"></i></a>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="pull-left mb-0 mt-2">
                        <i class="fa fa-arrow-right"></i> Receivings List
                    </div>
                    <div class="pull-right text-right">
                        <a href="{{ route('receivings.export', ['q' => Request::get('q')]) }}" class="btn btn-secondary"><i class="fa fa-file-excel-o"></i> Export</a>
                        <a href="{{ route('receivings.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Create</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Supplier</th>
                                    <th>Created By</th>
                                    <th>Total Items</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($receivings as $key => $receiving)
                                    <tr>
                                        <td>{{ $receivings->firstItem() + $key }}</td>
                                        <td>{{ $receiving->code }}</td>
                                        <td>{{ $receiving->supplier->name }}</td>
                                        <td>{{ $receiving->user->name }}</td>
                                        <td>{{ $receiving->totalItems }}</td>
                                        <td>{{ $receiving->created_at }}</td>
                                        <td>
                                            <a href="{{ route('receivings.edit', $receiving) }}"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('receivings.show', $receiving) }}" class="ml-2 text-info"><i class="fa fa-bars"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="table-info">
                                        <td colspan="7" align="center">Receivings empty or not found.</td>
                                    <tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer small text-muted">
                    <p class="pull-left mb-0 mt-2">From {{ $receivings->firstItem() }} to {{ $receivings->lastItem() }} of {{ $receivings->total() }} data </p>
                    {{ $receivings->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection