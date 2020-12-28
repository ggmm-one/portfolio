@extends('layouts.base')

@include('layouts.navbars.primary.main')
@include('layouts.navbars.secondary.resources')

@section('content')

    <div class="card">
        <div class="card-header">
            <span>{{ __('Resources') }}</span>
            @can('create', App\Resource::class) <a href="{{ route('resources.create') }}" class="btn btn-primary">{{ __('Add') }}</a> @endcan
        </div>

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

    </div>

@endsection
