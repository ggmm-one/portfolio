@extends('layouts.frame_app')

@section('pagetitle', __('Resource Types'))
@section('bodyid', 'app-admin-resource-types-index')

@include('layouts.navbars.admin')

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
        @each('resource_types.index_item', $resourceTypes, 'resourceType', 'resource_types.index_item_empty')
    </tbody>
</table>
@endsection