@extends('layouts.frame_app')

@section('pagetitle', $portfolioUnit->exists ? 'Edit Portfolio' : 'Add Portfolio')
@section('bodyid', 'app-portfolios-portfolio-info-edit')

@section('content')

    @include('portfolios.inc.portfolios_header')

    <form method="POST" action="{{ $formAction }}" class="app-form">
        @csrf
        @if ($portfolioUnit->exists)
            @method('PATCH')
            @form_public_id(['control_value' => $portfolioUnit->pid])
        @endif
        @form_input(['input_type' => 'text', 'control_id' => 'name', 'control_label' => 'Name', 'control_value' => old('name', $portfolioUnit->name), 'control_validation' => 'required autofocus maxlenght='.\App\PortfolioUnit::DD_NAME_LENGTH])
        @form_select(['control_id' => 'type', 'control_label' => 'Type', 'control_value' => old('type', $portfolioUnit->type),'select_options' => App\PortfolioUnit::TYPES, 'control_size' => 'm', 'disabled' => $portfolioUnit->isRoot()])
        @form_select(['control_id' => 'parent_pid', 'control_label' => 'Parent', 'control_value' => old('parent_pid', $portfolioUnit->parent_pid),'select_options' => $availParents, 'disabled' => $portfolioUnit->isRoot()])
        @form_textarea(['control_id' => 'description', 'control_label' => 'Description', 'control_value' => old('description', $portfolioUnit->description), 'control_validation' => 'maxlength='.\App\portfolioUnit::DD_DESCRIPTION_LENGTH])
        @can('update', $portfolioUnit) @form_submit @endcan
    </form>

@endsection

@push('bottom')
<script src="/js/delete_dialog.js"></script>
@endpush
