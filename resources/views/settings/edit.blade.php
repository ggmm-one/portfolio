@extends('layouts.base')

@include('layouts.navbars.primary.main')
@include('layouts.navbars.secondary.admin')

@section('content')

    @bind($setting)
    <x-form>
        <x-ggmm-form-header>
            <x-form-input name="evaluation_max" label="Evaluation Highest Score" :max="\App\Setting::DD_EVALUATION_MAX" autofocus required />
            <x-form-submit>Save</x-form-submit>
        </x-ggmm-form-header>
    </x-form>
    @endbind

@endsection
