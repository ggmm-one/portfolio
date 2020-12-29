@extends('layouts.base')

@include('layouts.navbars.primary.main')
@include('layouts.navbars.tertiary.portfolios')

@section('content')

    @bind($portfolio)
    <x-form>
        <x-ggmm-form-header>
            <x-form-input name="name" label="Name" required autofocus :maxlenght="\App\Portfolio::DD_NAME_LENGTH" />
            <x-form-select name="parent_id" label="Parent" :options="\App\Portfolio::selectList()->get()->pluck('name', 'id')" />
            <x-form-textarea name="description" label="Description" :maxlength="\App\Portfolio::DD_DESCRIPTION_LENGTH" />
            <x-form-submit>Save</x-form-submit>
        </x-ggmm-form-header>
    </x-form>
    @endbind

@endsection
