@extends('layouts.sections.resources')

@section('pagetitle', __('Resource Capacity'))
@section('bodyid', 'app-resources-capacities-index')

@section('subcontent')

    @include('resources.resources.inc.header')

    <nav class="navbar">
        <span class="navbar-brand">&nbsp;</span>
        <div>
            <a href="{{ route('resources.capacities.create', compact('resource')) }}" class="btn btn-primary">{{ __('Add') }}</a>
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
                @include('resources.capacities.index_item_empty')
            @else
                @foreach ($capacities as $capacity)
                    @include('resources.capacities.index_item')
                @endforeach
            @endif
        </tbody>
    </table>

@endsection

@push('bottom')
<script src="/js/delete_dialog.js"></script>
@endpush
