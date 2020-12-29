@extends('layouts.base')

@include('layouts.navbars.primary.main')

@section('content')

    <div class="card">
        <div class="card-header">
            <span>{{ __('Projects') }}</span>
            @can('create', App\Project::class) <a href="{{ route('projects.create') }}" class="btn btn-primary">{{ __('Add') }}</a> @endcan
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Portfolio') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Score') }}</th>
                    <th>{{ __('Type') }}</th>
                </tr>
            </thead>
            <tbody>
                @each('projects.index_item', $projects, 'project', 'projects.index_item_empty')
            </tbody>
        </table>
    </div>

@endsection
