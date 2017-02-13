@include('partials.header')

<body>
    <div id="app">
        @include('partials.navbar')

        @include('partials.notification')

        @yield('content')
    </div>
    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script src="/js/all.js"></script>
</body>
</html>
