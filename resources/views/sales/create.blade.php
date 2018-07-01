@extends('layouts.app')

@section('main-content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    {{ Breadcrumbs::render('sales.create') }}

    <form-sales></form-sales>
</div>
@endsection