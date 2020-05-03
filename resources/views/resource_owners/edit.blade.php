@extends('layouts.frame_app')

@section('pagetitle', $resourceOwner->exists ? 'Edit Resource Owner' : 'Add Resource Owner')

@include('layouts.navbars.resources')

@section('content')

@include('inc.flash_msg')

<nav class="navbar navbar-light bg-light">
    <span class="navbar-brand">{{ __($resourceOwner->exists ? 'Edit Resource Owner' : 'Add Resource Owner') }}</span>
    @if ($resourceOwner->exists)
    <div class="app-action">
        <a href="{{ route('resources.index', ['owner' => $resourceOwner->pid]) }}">{{ __('Resources') }}</a>
        <x-delete-model :model="$resourceOwner" class="btn btn-primary" />
    </div>
    @endif
</nav>

<form method="POST" action="{{ $formAction }}" class="app-form">
    @csrf
    @if ($resourceOwner->exists)
    @method('PATCH')
    @form_public_id(['control_value' => $resourceOwner->pid])
    @endif
    @form_input(['input_type' => 'text', 'control_id' => 'name', 'control_label' => 'Name', 'control_value' => old('name', $resourceOwner->name), 'control_validation' => 'required autofocus maxlenght='.\App\ResourceOwner::DD_NAME_LENGTH])
    @form_input(['input_type' => 'email', 'control_id' => 'email', 'control_label' => 'Email', 'control_value' => old('email', $resourceOwner->email), 'control_validation' => 'required maxlenght='.\App\ResourceOwner::DD_EMAIL_LENGTH])
    @can('update', $resourceOwner) @form_submit @endcan
</form>

@endsection
