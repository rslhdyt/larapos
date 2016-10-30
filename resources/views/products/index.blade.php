@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Products
                    <div class="pull-right">

                        <a href="{{ url('products/create') }}" class="btn btn-primary btn-xs">Create</a>
                    </div>
                </div>
                <div class="panel-body">
                    <form method="GET">
                        <div class="form-group" style="margin:0">
                            <div class="input-group">
                                @if(!empty($keyword))
                                <span class="input-group-btn">
                                    <a href="{{ url('products') }}" class="btn btn-primary">Clear</a>
                                </span>
                                @endif
                                <input type="text" name="q" class="form-control" value="{{ $keyword }}">
                                <span class="input-group-btn">
                                    <button class="btn btn-success" type="submit">Search</button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($products as $key => $product)
                        <tr>
                            <td>{{ $products->firstItem() + $key }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>
                                <form id="delete-product" action="{{ url('products/' . $product->id) }}" method="POST" class="form-inline">
                                    <input type="hidden" name="_method" value="delete">
                                    {{ csrf_field() }}
                                    <input type="submit" value="Delete" class="btn btn-danger btn-xs pull-right btn-delete">
                                </form>
                                <a href="{{ url('products/' . $product->id . '/edit') }}" class="btn btn-primary btn-xs pull-right">Edit</a>
                            </td>
                        </tr>
                    @empty
                        @include('partials.table-blank-slate', ['colspan' => 4])
                    @endforelse
                    </tbody>
                </table>

                <div class="panel-footer" style="text-align: right;">
                    {{ $products->links() }}
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection