@extends('layouts.base')

@include('layouts.navbars.primary.main')
@include('layouts.navbars.secondary.resources')
@include('layouts.navbars.tertiary.resources')

@section('content')

    @bind($resource)
    <x-form>
        <x-ggmm-form-header>
            <x-form-input name="name" label="Name" :maxlength="\App\Resource::DD_NAME_LENGTH" autofocus required />
            <x-form-select name="resource_type_id" label="Type" :options="\App\ResourceType::selectList()->get()->pluck('name', 'id')" />
            <x-form-select name="resource_owner_id" label="Owner" :options="\App\ResourceOwner::selectList()->get()->pluck('name', 'id')" />
            <x-form-textarea name="description" label="Description" :maxlength="\App\Resource::DD_DESCRIPTION_LENGTH" />
            <x-form-submit>Save</x-form-submit>
        </x-ggmm-form-header>
    </x-form>
    @endbind

@endsection
