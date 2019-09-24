@extends('layouts.frame_app')

@section('pagetitle', $resourceType->exists ? 'Edit Resource Type' : 'Add Resource Type')
@section('bodyid', 'app-admin-resource-types-edit')

@include('admin.inc.section_nav_bar')

@section('content')

    @include('inc.flash_msg')

    <nav class="navbar navbar-light bg-light app-nav-section">
        <span class="navbar-brand">{{ __($resourceType->exists ? 'Edit Resource Type' : 'Add Resource Type') }}</span>
        @includeWhen($resourceType->exists && auth()->user()->can('delete', $resourceType), 'inc.delete_btn', ['deleteAction' => route('admin.resource_types.destroy', ['resource_type' => $resourceType->pid])])
    </nav>

    <form method="POST" action="{{ $formAction }}" class="app-form">
        @csrf
        @if ($resourceType->exists)
            @method('PATCH')
            @form_public_id(['control_value' => $resourceType->pid])
        @endif
        @form_input(['input_type' => 'text', 'control_id' => 'name', 'control_label' => 'Name', 'control_value' => old('name', $resourceType->name), 'control_validation' => 'required autofocus maxlenght='.\App\ResourceType::DD_NAME_LENGTH])
        @form_select(['control_id' => 'category', 'control_label' => 'Category', 'control_value' => old('category', $resourceType->category),'select_options' => App\ResourceType::CATEGORIES, 'control_size' => 'm'])
        @if (auth()->user()->can('update', $resourceType)) @form_submit @endif
    </form>

@endsection
