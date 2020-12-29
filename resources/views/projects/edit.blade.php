@extends('layouts.base')

@include('layouts.navbars.primary.main')
@include('layouts.navbars.tertiary.projects')

@section('content')

    @bind($project)
    <x-form>
        <x-ggmm-form-header>
            <x-form-input name="name" label="Name" autofocus required :maxlenght="\App\Project::DD_NAME_LENGTH" />
            <x-form-input name="code" label="Code" required :maxlenght="\App\Project::DD_CODE_LENGTH" />
            <x-form-select name="portfolio_unit_id" label="Portfolio" :options="\App\PortfolioUnit::selectList($project->id)->get()->pluck('name', 'id')" />
            <x-form-select name="type" label="Type" :options="App\Project::TYPES" />
            <x-form-select name="status" label="Status" :options="App\Project::STATUS" />
            <x-form-input type="date" name="start" label="Start" />
            <x-form-input type="number" name="duration" label="Duration (months)" />
            <x-form-textarea name="description" label="Description" />
            <x-form-submit>Save</x-form-submit>
        </x-ggmm-form-header>
    </x-form>
    @endbind

@endsection
