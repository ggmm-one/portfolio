@extends('layouts.frame_app')

@section('pagetitle', 'Resources')
@section('bodyid', 'app-projects-resources-edit')

@section('content')

    @include('inc.flash_msg')

    @include('projects.inc.projects_header')

    <br>

    <nav class="navbar navbar-light bg-light">
        <span class="navbar-brand">{{ __($allocation->exists ? 'Edit Resource Allocation' : 'Add Resource Allocation') }}</span>
        @if ($allocation->exists)
            <div class="app-action">
                @includeWhen(auth()->user()->can('delete', $resourceOwner), 'inc.delete_btn', compact('deleteAction'))
            </div>
        @endif
    </nav>

    <form method="POST" action="{{ $formAction }}" class="app-form">
        @csrf
        @if($allocation->exists)
            @form_public_id(['control_value' => $allocation->pid])
            @method('PATCH')
        @endif

        @form_select(['control_id' => 'resource_pid', 'control_label' => 'Resource', 'control_value' => old('resource_pid', $allocation->resource_pid), 'select_options' => $resources])
        @form_select(['control_id' => 'month', 'control_label' => 'Month', 'control_value' => old('month', $allocation->month), 'select_options' => $months, 'control_size' => 'm'])
        @form_input(['input_type' => 'number', 'control_id' => 'quantity', 'control_label' => 'Quantity', 'control_value' => old('quantity', $allocation->quantity), 'control_size' => 'm'])
        @form_input(['input_type' => 'number', 'control_id' => 'sort_order', 'control_label' => 'Sort Order', 'control_value' => old('sort_order', $allocation->sort_order), 'control_size' => 'm'])
        @can('update', $allocation) @form_submit @endcan

    </form>

@endsection