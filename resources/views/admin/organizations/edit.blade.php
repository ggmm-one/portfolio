@extends('layouts.sections.admin')

@section('pagetitle', __('Edit Organization'))
@section('bodyid', 'app-admin-organizations-edit')

@section('content')

@include('inc.flash_msg')

<nav class="navbar navbar-light bg-light app-nav-section">
    <span class="navbar-brand">{{ __('Edit Organization') }}</span>
</nav>

<form method="POST" action="{{ route('admin.organizations.update', ['organization' => 'X']) }}" class="app-form">
    @method('PATCH')
    @csrf
    @form_input(['input_type' => 'text', 'control_id' => 'name', 'control_label' => 'Name', 'control_value' => old('name', $organization->name), 'control_validation' => 'required autofocus maxlenght='.\App\Organization::DD_NAME_LENGTH])
    @form_submit
</form>

@endsection
