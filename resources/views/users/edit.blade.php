@extends('layouts.base')

@include('layouts.navbars.primary.main')
@include('layouts.navbars.secondary.admin')

@section('content')

    @bind($user)
    <x-form>
        <x-ggmm-form-header>
            <x-form-input name="name" label="Name" :maxlength="\App\User::DD_NAME_LENGTH" default="New User" autofocus required />
            <x-form-input type="email" name="email" label="Email" :maxlength="\App\User::DD_EMAIL_LENGTH" required />
            <x-form-select name="role_id" label="Role" :options="\App\Role::selectList()->get()->pluck('name', 'id')" />
            <x-form-submit>Save</x-form-submit>
        </x-ggmm-form-header>
    </x-form>

@endsection
