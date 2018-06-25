@extends('layouts.app')

@section('main-content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    {{ Breadcrumbs::render('receivings.edit', $receiving) }}

    <form-receiving :receiving-id="{{ $receiving }}"></form-receiving>
</div>
@endsection