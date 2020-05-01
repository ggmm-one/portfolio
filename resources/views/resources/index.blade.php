@extends('layouts.frame_app')

@section('pagetitle', 'Resources')

@section('content')

@include('inc.flash_msg')

@include('layouts.navbars.resources')

<nav class="navbar navbar-light bg-light">
    <div>
        <span class="navbar-brand">
            {{ __('Resources') }}
            @include('inc.filtered_tag')
        </span>
    </div>
    @can('create', App\Resource::class) <a href="{{ route('resources.create') }}" class="btn btn-primary">{{ __('Add') }}</a> @endcan
</nav>

<table class="table">
    <thead>
        <tr>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Type') }}</th>
            <th>{{ __('Owner') }}</th>
            <th>{{ __('Actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @each('resources.index_item', $resources, 'resource', 'resources.index_item_empty')
    </tbody>
</table>

@endsection
