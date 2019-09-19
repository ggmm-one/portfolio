@extends('layouts.sections.admin')

@section('pagetitle', __($role->exists ? 'Edit Role' : 'Add Role'))
@section('bodyid', 'app-admin-roles-edit')

@section('content')

@include('inc.flash_msg')

<nav class="navbar navbar-light bg-light app-nav-section">
    <span class="navbar-brand">{{ __($role->exists ? 'Edit Role' : 'Add Role') }}</span>
    @includeWhen($role->exists, 'inc.delete_btn', ['deleteAction' => route('admin.roles.destroy', ['role' => $role->pid])])
</nav>

<form method="POST" action="{{ route('admin.roles.update', ['role' => $role->pid]) }}" class="app-form">
    @csrf
    @if ($role->exists)
        @method('PATCH')
        @form_public_id(['control_value' => $role->pid])
    @endif
    @form_input(['input_type' => 'text', 'control_id' => 'name', 'control_label' => 'Name', 'control_value' => old('name', $role->name), 'control_validation' => 'required autofocus maxlenght='.\App\Role::DD_NAME_LENGTH])
    @form_submit
</form>

@endsection
