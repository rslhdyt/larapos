@include('partials.header')

<body>
    <div id="app">
        @include('partials.navbar')

        @include('partials.notification')

        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">Settings Menu</div>
                        <ul class="list-group">
                            <a href="{{ url('settings/profile') }}"  class="list-group-item">Profile</a>
                            <a href="{{ url('settings/general') }}"  class="list-group-item">General</a>
                            <a href="{{ url('settings/personal-tokens') }}"  class="list-group-item">Personal Token</a>
                            <a href="{{ url('settings/roles') }}"  class="list-group-item">Roles</a>
                            <a href="{{ url('settings/permissions') }}"  class="list-group-item">Permissions</a>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
