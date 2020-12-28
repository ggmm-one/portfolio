@extends('layouts.base')

@include('layouts.navbars.primary.main')
@include('layouts.navbars.secondary.admin')

@section('content')

    <div class="card">
        <div class="card-header">
            <span>{{ __('Resource Types') }}</span>
            @can('create', App\ResourceType::class) <a href="{{ route('resource_types.create') }}" class="btn btn-primary">{{ __('Add') }}</a> @endif
        </div>

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
    </div>
@endsection
