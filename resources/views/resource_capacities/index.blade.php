@extends('layouts.frame_app')

@section('pagetitle', 'Resource Capacity')

@include('layouts.navbars.resources')

@section('content')

@include('layouts.headers.resources')

<nav class="navbar">
    <span class="navbar-brand">&nbsp;</span>
    <div>
        @can('create', App\ResourceCapacity::class) <a href="{{ route('resource_capacities.create', compact('resource')) }}" class="btn btn-primary">{{ __('Add') }}</a> @endcan
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
        @include('resource_capacities.index_item_empty')
        @else
        @foreach ($capacities as $capacity)
        @include('resource_capacities.index_item')
        @endforeach
        @endif
    </tbody>
</table>

@endsection

@push('bottom')
<script src="/js/delete_dialog.js"></script>
@endpush
