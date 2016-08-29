<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    @include('partials.navbar')

    @include('partials.notification')

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Settings Menu</div>
                    <ul class="list-group">
                        <a href="{{ url('settings/profile') }}"  class="list-group-item">Profile</a>
                        <a href="{{ url('settings/account') }}"  class="list-group-item">Account</a>
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

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
