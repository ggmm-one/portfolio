@extends('layouts.frame_app')

@section('pagetitle', $role->exists ? 'Edit Role' : 'Add Role')
@section('bodyid', 'app-admin-roles-edit')

@include('layouts.navbars.admin')

@section('content')

@include('inc.flash_msg')

@php var_dump($role); @endphp

<nav class="navbar navbar-light bg-light app-nav-section">
    <span class="navbar-brand">{{ __($role->exists ? 'Edit Role' : 'Add Role') }}</span>
    @includeWhen($role->exists && auth()->user()->can('delete', $role), 'inc.delete_btn', ['deleteAction' => route('roles.destroy', ['role' => 'as'])])
</nav>

<form method="POST" action="{{ route('roles.update', ['role' => 'as']) }}" class="app-form">
    @csrf
    @if ($role->exists)
    @method('PATCH')
    @form_public_id(['control_value' => $role->pid])
    @endif
    @form_input(['input_type' => 'text', 'control_id' => 'name', 'control_label' => 'Name', 'control_value' => old('name', $role->name), 'control_validation' => 'required autofocus maxlenght='.\App\Role::DD_NAME_LENGTH])
    @foreach (['portfolios', 'projects', 'resources', 'admin'] as $type)
    <div class="form-group form-row">
        <label for="permission_{{ $type }}" class="col-sm-2 offset-sm-1 col-form-label">{{ __(Str::title($type)) }}</label>
        @foreach (\App\Role::PERMISSIONS as $k => $v)
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="permission_{{ $type }}" id="permission_{{ $type }}" value="{{ $k }}" required @if ($role->{'permission_'.$type} == $k)
            checked=checked
            @endif
            >
            <label class="form-check-label" for="permission_{{ $type }}">{{ __($v) }}</label>
        </div>
        @endforeach
    </div>
    @endforeach
    @can('update', $role) @form_submit @endcan
</form>

@endsection