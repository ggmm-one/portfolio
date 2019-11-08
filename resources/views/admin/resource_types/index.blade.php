@extends('layouts.frame_app')

@section('pagetitle', __('Resource Types'))
@section('bodyid', 'app-admin-resource-types-index')

@include('admin.inc.section_nav_bar')

@section('content')

    @include('inc.flash_msg')

    <nav class="navbar navbar-light bg-light">
        <span class="navbar-brand">{{ __('Resource Types') }}</span>
        @can('create', App\resourceType::class) <a href="{{ route('admin.resource_types.create') }}" class="btn btn-primary">{{ __('Add') }}</a> @endif
    </nav>

    <table class="table">
        <thead>
            <tr>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Category') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
        @each('admin.resource_types.index_item', $resourceTypes, 'resourceType', 'admin.resource_types.index_item_empty')
        </tbody>
    </table>
@endsection
