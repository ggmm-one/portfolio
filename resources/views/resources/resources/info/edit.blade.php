@extends('layouts.frame_app')

@section('pagetitle', 'Resources')
@section('bodyid', 'app-resources-resources-edit')

@include('resources.inc.section_nav_bar')

@section('content')

    @include('resources.inc.resources_header')

    <form method="POST" action="{{ $formAction }}" class="app-form">
        @csrf
        @if($resource->exists)
            @form_public_id(['control_value' => $resource->pid])
            @method('PATCH')
        @endif
        @form_input(['input_type' => 'text', 'control_id' => 'name', 'control_label' => 'Name', 'control_value' => old('name', $resource->name), 'control_validation' => 'required autofocus maxlenght='.\App\Project::DD_NAME_LENGTH])
        @form_select(['control_id' => 'resource_type_pid', 'control_label' => 'Type', 'control_value' => old('resource_type_pid', $resource->resource_type_pid),'select_options' => \App\ResourceType::getSelectList()])
        @form_select(['control_id' => 'resource_owner_pid', 'control_label' => 'Owner', 'control_value' => old('resource_owner_pid', $resource->resource_owner_pid),'select_options' => \App\ResourceOwner::getSelectList()])
        @form_textarea(['control_id' => 'description', 'control_label' => 'Description', 'control_value' => old('description', $resource->description), 'control_validation' => 'maxlength='.\App\Resource::DD_DESCRIPTION_LENGTH])
        @form_submit
    </form>

@endsection
