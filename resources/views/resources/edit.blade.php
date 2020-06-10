@extends('layouts.frame_app')

@section('pagetitle', 'Resources')

@include('layouts.navbars.resources')

@section('content')

@include('layouts.headers.resources')

<form method="POST" action="{{ $resource->exists ? route('resources.update', compact('resource')) : route('resources.store') }}" class="app-form">
    @csrf
    @if($resource->exists)
    @method('PATCH')
    @endif
    @form_input(['input_type' => 'text', 'control_id' => 'name', 'control_label' => 'Name', 'control_value' => old('name', $resource->name), 'control_validation' => 'required autofocus maxlenght='.\App\Project::DD_NAME_LENGTH])
    @form_select(['control_id' => 'resource_type_hashid', 'control_label' => 'Type', 'control_value' => old('resource_type_hashid', $resource->resource_type_hashid),'select_options' => \App\ResourceType::getSelectList()])
    @form_select(['control_id' => 'resource_owner_hashid', 'control_label' => 'Owner', 'control_value' => old('resource_owner_hashid', $resource->resource_owner_hashid),'select_options' => \App\ResourceOwner::getSelectList()])
    @form_textarea(['control_id' => 'description', 'control_label' => 'Description', 'control_value' => old('description', $resource->description), 'control_validation' => 'maxlength='.\App\Resource::DD_DESCRIPTION_LENGTH])
    @can('update', $resource) @form_submit @endcan
</form>

@endsection
