@extends('layouts.frame_app')

@section('pagetitle', $resourceCapacity->exists ? 'Edit Capacity' : 'Add Capacity')
@section('bodyid', 'app-resources-capacities-edit')

@include('resources.inc.section_nav_bar')

@section('content')

    @include('resources.inc.resources_header')

    <form method="POST" action="{{ $formAction }}" class="app-form">
        @csrf
        @if($resourceCapacity->exists)
            @form_public_id(['control_value' => $resourceCapacity->pid])
            @method('PATCH')
        @endif
        @form_input(['input_type' => 'date', 'control_id' => 'start', 'control_label' => 'Start', 'control_value' => old('start', $resourceCapacity->start->toDateString()), 'control_validation' => 'required autofocus'])
        @form_input(['input_type' => 'date', 'control_id' => 'end', 'control_label' => 'End', 'control_value' => old('end', $resourceCapacity->end->toDateString()), 'control_validation' => 'required'])
        @form_select(['control_id' => 'type', 'control_label' => 'Type', 'control_value' => old('type', $resourceCapacity->type),'select_options' => \App\ResourceCapacity::TYPES, 'control_size' => 'm'])
        @form_input(['input_type' => 'number', 'control_id' => 'quantity', 'control_label' => 'Quantity', 'control_value' => old('quantity', $resourceCapacity->quantity), 'control_size' => 'm', 'control_validation' => 'min=0 autofocus max='.\App\ResourceCapacity::DD_QUANTITY_MAX])
        @can('update', $resource)) @form_submit @endcan
    </form>

@endsection
