@extends('layouts.frame_app')

@section('pagetitle', 'Evaluations')
@section('bodyid', 'app-projects-evaluations-index')

@section('content')

    @include('inc.flash_msg')

    @include('projects.inc.projects_header')

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
                @include('projects.evaluations.index_item_empty')
            @else
                @foreach ($evaluationScores as $evaluationScore)
                    @include('projects.evaluations.index_item')
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

@endsection
