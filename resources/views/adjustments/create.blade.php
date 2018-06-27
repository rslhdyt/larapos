@extends('layouts.app')

@section('main-content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    {{ Breadcrumbs::render('adjustments.create') }}

    <form-adjustment></form-adjustment>
</div>
@endsection