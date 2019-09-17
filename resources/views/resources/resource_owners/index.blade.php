@extends('layouts.sections.resources')

@section('pagetitle', 'Resources')
@section('bodyid', 'app-resources-resources-owners-index')

@section('subcontent')

<nav class="navbar navbar-light bg-light">
    <span class="navbar-brand">{{ __('Resource Owners') }}</span>
    <a href="{{ route('resources.resource_owners.create') }}" class="btn btn-primary">{{ __('Add') }}</a>
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
        @each('resources.resource_owners.index_item', $resourceOwners, 'resourceOwner', 'resources.resource_owners.index_item_empty')
    </tbody>
</table>

@endsection
