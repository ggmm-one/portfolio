@extends('layouts.frame_app')

@section('pagetitle', __('Settings'))
@section('bodyid', 'app-admin-settings-edit')

@include('layouts.navbars.admin')

@section('content')

@include('inc.flash_msg')

<nav class="navbar navbar-light bg-light app-nav-section">
    <span class="navbar-brand">{{ __('Settings') }}</span>
</nav>

<form method="POST" action="{{ route('settings.update', [$setting]) }}" class="app-form">
    @csrf
    @method('PATCH')
    <h4>Evaluation</h4>
    @form_input(['input_type' => 'number', 'control_id' => 'evaluation_max', 'control_label' => 'Evaluation Highest Score', 'control_value' => old('evaluation_max', $setting->evaluation_max), 'control_validation' => 'required max='.\App\Setting::DD_EVALUATION_MAX, 'control_size' => 'm'])
    @form_submit
</form>

@endsection
