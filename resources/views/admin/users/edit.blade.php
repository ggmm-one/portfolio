@extends('layouts.frame_app')

@section('pagetitle', $user->exists ? 'Edit User' : 'Add User')
@section('bodyid', 'app-admin-users-edit')

@include('admin.inc.section_nav_bar')

@section('content')

    @include('inc.flash_msg')

    <nav class="navbar navbar-light bg-light app-nav-section">
        <span class="navbar-brand">{{ __($user->exists ? 'Edit User' : 'Add User') }}</span>
        @includeWhen($user->exists, 'inc.delete_btn', ['deleteAction' => route('admin.users.destroy', ['user' => $user->pid])])
    </nav>

    <form method="POST" action="{{ route('admin.users.update', ['user' => $user->pid]) }}" class="app-form">
        @csrf
        @if ($user->exists)
            @method('PATCH')
            @form_public_id(['control_value' => $user->pid])
        @endif
        @form_input(['input_type' => 'text', 'control_id' => 'name', 'control_label' => 'Name', 'control_value' => old('name', $user->name), 'control_validation' => 'required autofocus maxlenght='.\App\User::DD_NAME_LENGTH])
        @form_input(['input_type' => 'email', 'control_id' => 'email', 'control_label' => 'Email', 'control_value' => old('email', $user->email), 'control_validation' => 'required maxlenght='.\App\User::DD_NAME_LENGTH])
        @form_select(['control_id' => 'role_pid', 'control_label' => 'Role', 'control_value' => old('role_pid', $user->role_pid),'select_options' => App\Role::getSelectList()])
        @form_submit
    </form>

@endsection
