@extends('layouts.frame_app')

@page_title(['title' => $evaluationItem])

@include('layouts.navbars.admin')

@section('content')

    @include('inc.flash_msg')

    <nav class="navbar navbar-light bg-light">
        <span class="navbar-brand">{{ __($evaluationItem->exists ? 'Edit Evaluation Item' : 'Add Evaluation Item') }}</span>
        <x-delete-model :model="$evaluationItem" class="btn btn-primary" />
    </nav>

    <form method="POST"
        action="{{ $evaluationItem->exists ? route('evaluation_items.update', [$evaluationItem]) : route('evaluation_items.store') }}">
        @csrf
        @if ($evaluationItem->exists)
            @method('PATCH')
        @endif
        @form_input(['input_type' => 'text', 'control_id' => 'name', 'control_label' => 'Name', 'control_value' =>
        old('name', $evaluationItem->name), 'control_validation' => 'required autofocus
        maxlenght='.\App\EvaluationItem::DD_NAME_LENGTH])
        @form_textarea(['control_id' => 'instructions', 'control_label' => 'Instructions', 'control_value' =>
        old('instructions', $evaluationItem->instructions), 'control_validation' =>
        'maxlenght='.\App\EvaluationItem::DD_INSTRUCTIONS_LENGTH])
        @form_input(['input_type' => 'number', 'control_id' => 'weight', 'control_label' => 'Weight', 'control_value' =>
        old('weigth', $evaluationItem->weight), 'control_validation' => 'required max='.\App\EvaluationItem::DD_WEIGHT_MAX,
        'control_size' => 'm'])
        @form_input(['input_type' => 'number', 'control_id' => 'sort_order', 'control_label' => 'Sort Order',
        'control_value' => old('sort_order', $evaluationItem->sort_order), 'control_validation' => 'required
        max='.\App\EvaluationItem::DD_SORT_ORDER_MAX, 'control_size' => 'm'])

        @form_submit
    </form>

@endsection
