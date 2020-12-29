@extends('layouts.base')

@include('layouts.navbars.primary.main')
@include('layouts.navbars.tertiary.projects')

@section('content')

    <div class="card">
        <div class="card-header">
            <span>{{ __('Scores') }}</span>
            @can('create', App\Project::class) <a href="{{ route('projects.create') }}" class="btn btn-primary">{{ __('Add') }}</a> @endcan
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('Item') }}</th>
                    <th>{{ __('Score') }}</th>
                    <th>{{ __('Weight') }}</th>
                    <th>{{ __('Weighted Score') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @if ($evaluationScores->isEmpty())
                    @include('evaluation_scores.index_item_empty')
                @else
                    @foreach ($evaluationScores as $evaluationScore)
                        @include('evaluation_scores.index_item')
                    @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th>{{ __('Total') }}</th>
                    <th>{{ $project->formatted_score }}</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>

@endsection
