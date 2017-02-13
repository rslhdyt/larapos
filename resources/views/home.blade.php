@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!

                    <larapos-autocomplete label="Search..." src="api/products" placeholder="Cauu..."></larapos-autocomplete>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
