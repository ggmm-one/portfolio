@extends('layouts.base')

@include('layouts.navbars.primary.main')
@include('layouts.navbars.secondary.resources')
@include('layouts.navbars.tertiary.resources')

@section('content')

    @bind($resourceCapacity)
    <x-form>
        <x-ggmm-form-header>
            <x-form-input type="date" name="start" label="Start" autofocus required />
            <x-form-input type="date" name="end" label="End" required />
            <x-form-select name="type" label="Type" :options="\App\ResourceCapacity::TYPES" />
            <x-form-input type="number" name="quantity" label="Quantity" min="0" :max="\App\ResourceCapacity::DD_QUANTITY_MAX" required />
            <x-form-submit>Save</x-form-submit>
        </x-ggmm-form-header>
    </x-form>
    @endbind

@endsection
