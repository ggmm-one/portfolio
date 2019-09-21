@extends('layouts.frame_app')

@section('pagetitle', __('Roles'))
@section('bodyid', 'app-admin-roles-index')

@include('admin.inc.section_nav_bar')

@section('content')

    @include('inc.flash_msg')

    <nav class="navbar navbar-light bg-light">
        <span class="navbar-brand">{{ __('Roles') }}</span>
        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">{{ __('Add') }}</a>
    </nav>

    <table class="table">
        <thead>
            <tr>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
        @each('admin.roles.index_item', $roles, 'role', 'admin.roles.index_item_empty')
        </tbody>
    </table>

@endsection
