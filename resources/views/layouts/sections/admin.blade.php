@extends('layouts.frame_app')

@section('sectionnavbar')
<nav class="navbar navbar-expand-lg navbar-light bg-light app-nav-sub">
    <span class="navbar-brand">{{ __('Admin') }}</span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#adminnavbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse">
        <a class="nav-item nav-link" href="{{ route('admin.settings.edit', ['setting' => 'X']) }}">{{ __('Settings') }}</a>
        <a class="nav-item nav-link" href="{{ route('admin.evaluation_items.index') }}">{{ __('Evaluation') }}</a>
        <a class="nav-item nav-link" href="{{ route('admin.resource_types.index') }}">{{ __('Resource Types') }}</a>
        <a class="nav-item nav-link" href="{{ route('admin.users.index') }}">{{ __('Users') }}</a>
        <a class="nav-item nav-link" href="{{ route('admin.users.index') }}">{{ __('Roles') }}</a>
        <a class="nav-item nav-link" href="{{ route('admin.organizations.edit', ['organization' => 'X']) }}">{{ __('Organization') }}</a>
    </div>
</nav>
@endsection
