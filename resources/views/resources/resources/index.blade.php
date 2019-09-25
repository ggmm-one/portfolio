@extends('layouts.frame_app')

@section('pagetitle', 'Resources')
@section('bodyid', 'app-resources-resources-index')

@include('resources.inc.section_nav_bar')

@section('content')

    @include('inc.flash_msg')

    <nav class="navbar navbar-light app-nav-section">
        <div>
            <span class="navbar-brand">
                {{ __('Resources') }}
                @include('inc.filtered_tag')
            </span>
        </div>
        @if (auth()->user()->can('create', App\Resource::class)) <a href="{{ route('resources.resources.create') }}" class="btn btn-primary">{{ __('Add') }}</a> @endif
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

