@extends('layouts.frame_app')

@section('pagetitle', 'Edit Evaluation')
@section('bodyid', 'app-projects-evaluations-edit')

@section('content')

    @include('inc.flash_msg')

    @include('projects.inc.projects_header')

    <form method="POST" action="{{ route('projects.evaluations.update', ['project' => $project->pid, 'evaluation_score' => $evaluationScore]) }}" class="app-form">
        @csrf
        @method('PATCH')
        @form_input(['input_type' => 'text', 'control_id' => 'name', 'control_label' => 'Name', 'control_value' => $evaluationScore->evaluationItem->name, 'disabled' => true])
        @form_textarea(['control_id' => 'instructions', 'control_label' => 'Instructions', 'control_value' => $evaluationScore->evaluationItem->instructions, 'disabled' => true])
        @form_select(['control_id' => 'score', 'control_label' => 'Score', 'control_value' => old('score', $evaluationScore->score),'select_options' => array_combine(range(1,$setting->evaluation_max),range(1,$setting->evaluation_max)), 'control_validation' => 'required autofocus', 'control_size' => 'm'])
        @form_textarea(['control_id' => 'description', 'control_label' => 'Comments', 'control_value' => old('description', $evaluationScore->description), 'control_validation' => 'required maxlength='.\App\EvaluationScore::DD_DESCRIPTION_LENGTH])
        @can('update', $project) @form_submit @endcan
    </form>

@endsection
