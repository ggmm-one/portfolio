@extends('layouts.base')

@include('layouts.navbars.primary.main')
@include('layouts.navbars.secondary.resources')

@section('content')

    @bind($resourceOwner)
    <x-form>
        <x-ggmm-form-header>
            <x-form-input name="name" label="Name" autofocus required :maxlenght="\App\ResourceOwner::DD_NAME_LENGTH" />
            <x-form-input type="email" name="email" label="Email" required :maxlenght="\App\ResourceOwner::DD_EMAIL_LENGTH" />
            <x-form-submit>Save</x-form-submit>
        </x-ggmm-form-header>
    </x-form>
    @endbind

@endsection
