@extends('layouts.frame_app')

@section('pagetitle', __('Roles'))
@section('bodyid', 'app-admin-roles-index')

@include('layouts.navbar.admin')

@section('content')

@include('inc.flash_msg')

<nav class="navbar navbar-light bg-light">
    <span class="navbar-brand">{{ __('Roles') }}</span>
    @can('create', App\Role::class) <a href="{{ route('roles.create') }}" class="btn btn-primary">{{ __('Add') }}</a> @endcan
</nav>

<table class="table">
    <thead>
        <tr>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @each('roles.index_item', $roles, 'role', 'roles.index_item_empty')
    </tbody>
</table>

@endsection
