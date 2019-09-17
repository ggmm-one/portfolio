@extends('layouts.sections.admin')

@section('pagetitle', __('Users'))
@section('bodyid', 'app-admin-users-index')

@section('content')

@include('inc.flash_msg')

<nav class="navbar navbar-light bg-light">
    <span class="navbar-brand">{{ __('Users') }}</span>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">{{ __('Add') }}</a>
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
    @each('admin.users.index_item', $users, 'user', 'admin.users.index_item_empty')
    </tbody>
</table>
@endsection
