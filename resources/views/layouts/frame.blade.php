<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('pagetitle', config('app.name'))</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/css.css">
</head>
<body id="app-{{ str_replace('.', '-', Route::currentRouteName()) }}">
    <nav id="app-navbar" class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="/">{{ config('app.name') }}</a>
        <a href="#app-navbar" class="navbar-toggler app-navbar-toggler-open" type="button" aria-controls="app-navbar-nav" aria-expanded="false" aria-label="Open navigation">
            <span class="navbar-toggler-icon"></span>
        </a>
        <a href="#app-navbar-collapsed" class="navbar-toggler app-navbar-toggler-close" type="button" aria-controls="app-navbar-nav" aria-expanded="true" aria-label="Close navigation">
            <span class="navbar-toggler-icon"></span>
        </a>
        @yield('navbar')
    </nav>

    @yield('frame')

    <footer class="container text-center app-footer">
        <span>Portfolio Management (c) 2019 ggmm-one</span>
        <span>{{ \Carbon\Carbon::now()->toDateTimeString() }}</span>
    </footer>

</body>
</html>
