@extends('layouts.app')

@section('main-content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    {{ Breadcrumbs::render('unit-of-measures.index') }}

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
                        <a href="{{ route('unit-of-measures.index') }}" class="btn btn-dark mb-2 ml-sm-2"><i class="fa fa-refresh"></i></a>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="pull-left mb-0 mt-2">
                        <i class="fa fa-sort-alpha-asc"></i> Unit of Measures List
                    </div>
                    <div class="pull-right text-right">
                        <a href="{{ route('unit-of-measures.trash') }}" class="btn btn-dark"><i class="fa fa-recycle"></i> Trash</a>
                        <a href="{{ route('unit-of-measures.export', ['q' => Request::get('q')]) }}" class="btn btn-secondary"><i class="fa fa-file-excel-o"></i> Export</a>
                        <a href="{{ route('unit-of-measures.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Create</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Abbreviation</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($unitOfMeasures as $key => $unitOfMeasure)
                                    <tr>
                                        <td>{{ $unitOfMeasures->firstItem() + $key }}</td>
                                        <td>{{ $unitOfMeasure->name }}</td>
                                        <td>{{ $unitOfMeasure->abbreviation }}</td>
                                        <td>
                                            <a href="{{ route('unit-of-measures.edit', $unitOfMeasure) }}"><i class="fa fa-pencil"></i></a>
                                            <delete-action action="{{ route('api.unit-of-measures.destroy', $unitOfMeasure) }}" class="ml-2 text-danger">
                                                <i class="fa fa-trash"></i>
                                            </delete-action>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="table-info">
                                        <td colspan="4" align="center">Unit of Measures empty or not found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer small text-muted">
                    <p class="pull-left mb-0 mt-2">From {{ $unitOfMeasures->firstItem() }} to {{ $unitOfMeasures->lastItem() }} of {{ $unitOfMeasures->total() }} data </p>
                    {{ $unitOfMeasures->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection