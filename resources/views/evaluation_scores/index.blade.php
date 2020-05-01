@extends('layouts.frame_app')

@section('pagetitle', 'Evaluations')
@section('bodyid', 'app-projects-evaluations-index')

@section('content')

@include('inc.flash_msg')

@include('layouts.headers.projects')

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

@endsection
