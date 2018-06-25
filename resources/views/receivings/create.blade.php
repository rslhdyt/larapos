@extends('layouts.app')

@section('main-content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    {{ Breadcrumbs::render('receivings.create') }}

    <form-receiving></form-receiving>
</div>
@endsection