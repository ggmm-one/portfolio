@extends('layouts.base')

@include('layouts.navbars.primary.main')
@include('layouts.navbars.secondary.resources')

@section('content')

    <div class="card">
        <div class="card-header">
            <span>{{ __('Resource Owners') }}</span>
            @can('create', App\ResourceOwner::class) <a href="{{ route('resource_owners.create') }}" class="btn btn-primary">{{ __('Add') }}</a> @endcan
        </div>


        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @each('resource_owners.index_item', $resourceOwners, 'resourceOwner', 'resource_owners.index_item_empty')
            </tbody>
        </table>
    </div>

@endsection
