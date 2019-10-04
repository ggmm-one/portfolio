@extends('layouts.frame')

@section('navbar')
<div class="collapse navbar-collapse justify-content-between" id="headernavbar">
    <div class="navbar-nav">
        @can('portfoliosModule', App\User::class) <a class="nav-item nav-link app-nav-master-link" href="{{ route('portfolios.portfolios.index') }}">{{ __('Portfolios') }}</a> @endcan
        @can('projectsModule', App\User::class) <a class="nav-item nav-link app-nav-master-link" href="{{ route('projects.projects.index') }}">{{ __('Projects') }}</a> @endcan
        @can('resourcesModule', App\User::class) <a class="nav-item nav-link app-nav-master-link" href="{{ route('resources.root') }}">{{ __('Resources') }}</a> @endcan
        @can('adminModule', App\User::class) <a class="nav-item nav-link app-nav-master-link" href="{{ route('admin.root') }}">{{ __('Admin') }}</a> @endcan
    </div>
    <div class="navbar-nav">
        <a class="nav-item nav-link app-nav-master-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path style="fill:#fff;" d="M16 9v-4l8 7-8 7v-4h-8v-6h8zm-16-7v20h14v-2h-12v-16h12v-2h-14z"/></svg>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
    </div>
</div>
@endsection

@section('frame')
@yield('sectionnavbar')
<div class="container app-content">
@yield('content')
</div>
@endsection
