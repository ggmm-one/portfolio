@extends('layouts.sections.resources')

@section('pagetitle', $resourceOwner->exists ? 'Edit Resource Owner' : 'Add Resource Owner')
@section('bodyid', 'app-resources-resources-owners-edit')

@section('subcontent')

<nav class="navbar navbar-light bg-light">
    <span class="navbar-brand">{{ __($resourceOwner->exists ? 'Edit Resource Owner' : 'Add Resource Owner') }}</span>
    @if ($resourceOwner->exists)
        <div class="app-action">
            <a href="{{ route('resources.resources.index', ['owner' => $resourceOwner->pid]) }}">{{ __('Resources') }}</a>
            @include('inc.delete_btn', compact('deleteAction'))
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
    @form_submit
</form>

@endsection
