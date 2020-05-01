@extends('layouts.frame_app')

@section('pagetitle', $user->exists ? 'Edit User' : 'Add User')

@include('layouts.navbars.admin')

@section('content')

@include('inc.flash_msg')

<nav class="navbar navbar-light bg-light app-nav-section">
    <span class="navbar-brand">{{ __($user->exists ? 'Edit User' : 'Add User') }}</span>
    <x-delete-model :model="$user" class="btn btn-primary" />
</nav>

<form method="POST" action="{{ ($user->exists) ? route('users.update', ['user' => $user]) : route('users.store')}}" class="app-form">
    @csrf
    @if ($user->exists)
    @method('PATCH')
    @form_public_id(['control_value' => $user->pid])
    @endif
    @form_input(['input_type' => 'text', 'control_id' => 'name', 'control_label' => 'Name', 'control_value' => old('name', $user->name), 'control_validation' => 'required autofocus maxlenght='.\App\User::DD_NAME_LENGTH])
    @form_input(['input_type' => 'email', 'control_id' => 'email', 'control_label' => 'Email', 'control_value' => old('email', $user->email), 'control_validation' => 'required maxlenght='.\App\User::DD_NAME_LENGTH])
    @form_select(['control_id' => 'role_pid', 'control_label' => 'Role', 'control_value' => old('role_pid', $user->role_pid),'select_options' => App\Role::getSelectList()])
    @can('update', $user) @form_submit @endcan
</form>

@endsection
