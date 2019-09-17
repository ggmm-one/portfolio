@extends('layouts.sections.resources')

@section('pagetitle', 'Resources')
@section('bodyid', 'app-resources-resources-index')

@section('subcontent')

<nav class="navbar navbar-light app-nav-section">
    <div>
        <span class="navbar-brand">
            {{ __('Resources') }}
            @include('inc.filtered_tag')
        </span>
    </div>
    <a href="{{ route('resources.resources.create') }}" class="btn btn-primary">{{ __('Add') }}</a>
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
        @each('resources.resources.index_item', $resources, 'resource', 'resources.resources.index_item_empty')
    </tbody>
</table>

@endsection

