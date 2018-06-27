@include('partials.html-header')

<body class="bg-dark">
    <div id="app">
        @yield('main-content')
    </div>
    
    @include('partials.scripts')
</body>