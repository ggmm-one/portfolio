<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('pagetitle', config('app.name'))</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/css.css">
</head>

<body id="{{ str_replace('.', '-', Route::currentRouteName()) }}">

    @yield('navbar-primary')
    @yield('navbar-secondary')
    @yield('navbar-tertiary')
    <div class="container">
        @include('inc.flash_msg')
        @yield('content')
    </div>

    <footer>
        <span>Portfolio Management (c) 2021 ggmm-one</span>
        <span>{{ \Carbon\Carbon::now()->toDateTimeString() }}</span>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous">
    </script>

</body>

</html>
