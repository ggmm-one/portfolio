@extends('layouts.base')

@include('layouts.navbars.primary.main')
@include('layouts.navbars.secondary.admin')

@section('content')

    @bind($role)
    <x-form>
        <fieldset class="form-group">
            <x-ggmm-form-header>
                <x-form-input name="name" label="Name" :maxlength="\App\Role::DD_NAME_LENGTH" default="New Role" autofocus required />
                <x-form-group name="permission_portfolios" label="Portfolios" :default="\App\Role::PERMISSION_NONE" inline>
                    <x-form-radio name="permission_portfolios" :value="\App\Role::PERMISSION_NONE" label="None" />
                    <x-form-radio name="permission_portfolios" :value="\App\Role::PERMISSION_READ" label="Read" />
                    <x-form-radio name="permission_portfolios" :value="\App\Role::PERMISSION_ALL" label="All" />
                </x-form-group>
                <x-form-group name="permission_projects" label="Projects" :default="\App\Role::PERMISSION_NONE" inline>
                    <x-form-radio name="permission_projects" :value="\App\Role::PERMISSION_NONE" label="None" />
                    <x-form-radio name="permission_projects" :value="\App\Role::PERMISSION_READ" label="Read" />
                    <x-form-radio name="permission_projects" :value="\App\Role::PERMISSION_ALL" label="All" />
                </x-form-group>
                <x-form-group name="permission_resources" label="Resources" :default="\App\Role::PERMISSION_NONE" inline>
                    <x-form-radio name="permission_resources" :value="\App\Role::PERMISSION_NONE" label="None" />
                    <x-form-radio name="permission_resources" :value="\App\Role::PERMISSION_READ" label="Read" />
                    <x-form-radio name="permission_resources" :value="\App\Role::PERMISSION_ALL" label="All" />
                </x-form-group>
                <x-form-group name="permission_admin" label="Resources" :default="\App\Role::PERMISSION_NONE" inline>
                    <x-form-radio name="permission_admin" :value="\App\Role::PERMISSION_NONE" label="None" />
                    <x-form-radio name="permission_admin" :value="\App\Role::PERMISSION_READ" label="Read" />
                    <x-form-radio name="permission_admin" :value="\App\Role::PERMISSION_ALL" label="All" />
                </x-form-group>
                <x-form-submit>Save</x-form-submit>
            </x-ggmm-form-header>
    </x-form>
    @endbind

@endsection
