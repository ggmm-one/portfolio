@extends('layouts.base')

@include('layouts.navbars.primary.main')
@include('layouts.navbars.secondary.admin')

@section('content')

    @bind($evaluationItem)
    <x-form>
        <x-ggmm-form-header>
            <x-form-input name="name" label="Name" :maxlength="\App\EvaluationItem::DD_NAME_LENGTH" autofocus required />
            <x-form-input type="number" name="weight" label="Weight" required :max="\App\EvaluationItem::DD_WEIGHT_MAX" />
            <x-form-textarea name="instructions" label="Instructions" :maxlenght="\App\EvaluationItem::DD_INSTRUCTIONS_LENGTH" />
            <x-form-input type="number" name="sort_order" label="Sort Order" required :max="\App\EvaluationItem::DD_SORT_ORDER_MAX" />
            <x-form-submit>Save</x-form-submit>
        </x-ggmm-form-header>
    </x-form>
    @endbind

@endsection
