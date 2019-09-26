@extends('layouts.frame_app')

@section('pagetitle', 'Resource Capacity')
@section('bodyid', 'app-resources-capacities-index')

@include('resources.inc.section_nav_bar')

@section('content')

    @include('resources.inc.resources_header')

    <nav class="navbar">
        <span class="navbar-brand">&nbsp;</span>
        <div>
            @if (auth()->user()->can('create', App\ResourceCapacity::class)) <a href="{{ route('resources.capacities.create', compact('resource')) }}" class="btn btn-primary">{{ __('Add') }}</a> @endif
        </div>
    </nav>

    <table class="table">
        <thead>
            <tr>
                <th>{{ __('Start') }}</th>
                <th>{{ __('End') }}</th>
                <th>{{ __('Type') }}</th>
                <th>{{ __('Quantity') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @if ($capacities->isEmpty())
                @include('resources.resources.capacities.index_item_empty')
            @else
                @foreach ($capacities as $capacity)
                    @include('resources.resources.capacities.index_item')
                @endforeach
            @endif
        </tbody>
    </table>

@endsection

@push('bottom')
<script src="/js/delete_dialog.js"></script>
@endpush
