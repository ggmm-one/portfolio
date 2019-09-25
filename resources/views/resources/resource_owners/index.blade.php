@extends('layouts.frame_app')

@section('pagetitle', 'Resources')
@section('bodyid', 'app-resources-resources-owners-index')

@include('resources.inc.section_nav_bar')

@section('content')

    @include('inc.flash_msg')

    <nav class="navbar navbar-light bg-light">
        <span class="navbar-brand">{{ __('Resource Owners') }}</span>
        @if (auth()->user()->can('create', App\ResourceOwner::class)) <a href="{{ route('resources.resource_owners.create') }}" class="btn btn-primary">{{ __('Add') }}</a> @endif
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
