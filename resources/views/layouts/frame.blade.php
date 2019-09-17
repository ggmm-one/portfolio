<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>@yield('pagetitle', 'NextPortfolio')</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="/css/bootstrap.css" >
<link rel="stylesheet" href="/css/css.css" >
<script src="/js/jquery.js"></script>
<script src="/js/bootstrap.js"></script>
</head>
<body id="@yield('bodyid')">
<nav class="navbar navbar-expand-sm navbar-dark bg-dark app-nav-master">
    <a class="navbar-brand" href="/">Next Portfolio</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#headernavbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    @yield('navbar')

</nav>
@yield('frame')
<footer class="container text-center app-footer">
    <span>Next Portfolio</span>
    <span>{{ \Carbon\Carbon::now()->toDateTimeString() }}</span>
</footer>
@stack('bottom')
</body>
</html>
