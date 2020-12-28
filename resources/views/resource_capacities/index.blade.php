@extends('layouts.base')

@include('layouts.navbars.primary.main')
@include('layouts.navbars.secondary.resources')
@include('layouts.navbars.tertiary.resources')

@section('content')

    <div class="card">
        <div class="card-header">
            <span>{{ __('Capacity') }}</span>
            @can('create', App\ResourceCapacity::class) <a href="{{ route('resource_capacities.create', compact('resource')) }}" class="btn btn-primary">{{ __('Add') }}</a> @endcan
        </div>

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
    </div>

@endsection

@push('bottom')
    <script src="/js/delete_dialog.js"></script>
@endpush
