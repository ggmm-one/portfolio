@extends('layouts.frame_app')

@section('pagetitle', $project->exists ? 'Edit Project' : 'Add Project')

@section('content')

@include('inc.flash_msg')

@include('layouts.headers.projects')

<form method="POST" action="{{ $formAction }}" class="app-form">
    @csrf
    @if($project->exists)
    @method('PATCH')
    @endif
    @form_input(['input_type' => 'text', 'control_id' => 'name', 'control_label' => 'Name', 'control_value' => old('name', $project->name), 'control_validation' => 'required autofocus maxlenght='.\App\Project::DD_NAME_LENGTH])
    @form_input(['input_type' => 'text', 'control_id' => 'code', 'control_label' => 'Code', 'control_value' => old('code', $project->code), 'control_validation' => 'maxlength='.\App\Project::DD_CODE_LENGTH, 'control_size' => 'm'])
    @form_select(['control_id' => 'portfolio_unit_hashid', 'control_label' => 'Portfolio', 'control_value' => old('portfolio_unit_hashid', $project->portfolio_unit_hashid),'select_options' => $portfolios])
    @form_select(['control_id' => 'type', 'control_label' => 'Type', 'control_value' => old('type', $project->type),'select_options' => App\Project::TYPES, 'control_size' => 'm'])
    @form_select(['control_id' => 'status', 'control_label' => 'Status', 'control_value' => old('status', $project->status),'select_options' => App\Project::STATUS, 'control_size' => 'm'])
    @form_input(['input_type' => 'date', 'control_id' => 'start', 'control_label' => 'Start', 'control_value' => old('start', isset($project->start) ? $project->start->toDateString() : '')])
    @form_input(['input_type' => 'number', 'control_id' => 'duration', 'control_label' => 'Duration (months)', 'control_value' => old('duration', $project->duration), 'control_validation' => 'min=1 max='.\App\Project::DD_DURATION_MAX, 'control_size' => 'm'])
    @form_textarea(['control_id' => 'description', 'control_label' => 'Description', 'control_value' => old('description', $project->description), 'control_validation' => 'maxlength='.\App\Project::DD_DESCRIPTION_LENGTH])
    @can('update', $project) @form_submit @endcan
</form>

@endsection
