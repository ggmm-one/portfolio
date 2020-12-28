@extends('layouts.base')

@include('layouts.navbars.primary.main')
@include('layouts.navbars.secondary.admin')

@section('content')

    @bind($resourceType)
    <x-form>
        <x-ggmm-form-header>
            <x-form-input name="name" label="Name" :maxlength="\App\ResourceType::DD_NAME_LENGTH" autofocus required />
            <x-form-select name="category" label="Category" :options="\App\ResourceType::CATEGORIES" />
            <x-form-submit>Save</x-form-submit>
        </x-ggmm-form-header>
    </x-form>

@endsection
