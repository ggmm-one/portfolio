@extends('layouts.frame_app')

@section('pagetitle', __('Users'))
@section('bodyid', 'app-admin-users-index')

@include('layouts.navbar.admin')

@section('content')

@include('inc.flash_msg')

<nav class="navbar navbar-light bg-light">
    <span class="navbar-brand">{{ __('Users') }}</span>
    @can('create', App\User::class) <a href="{{ route('users.create') }}" class="btn btn-primary">{{ __('Add') }}</a> @endcan
</nav>

<table class="table">
    <thead>
        <tr>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Email') }}</th>
            <th>{{ __('Actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @each('users.index_item', $users, 'user', 'users.index_item_empty')
    </tbody>
</table>

@endsection
