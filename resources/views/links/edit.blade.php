@extends('layouts.frame_app')

@section('pagetitle', __($link->exists? 'Edit Link' : 'Add Link'))

@section('content')

@include('inc.flash_msg')

<nav class="navbar navbar-light bg-light app-nav-section">
    <span class="navbar-brand">{{ __($link->exists? 'Edit Link' : 'Add Link') }}</span>
    @can('delete', $holdingModel)
    <span>
        <x-delete-model :model="$link" class="btn btn-primary" />
    </span>
    @endcan
</nav>

<form method="POST" action="{{ route(str_replace('edit', 'update', str_replace('create', 'store', Request::route()->getName())), array_merge(Request::route()->parameters(), compact('link'))) }}" class="app-form">
    @csrf
    @if($link->exists)
    @method('PATCH')
    @endif
    @form_input(['input_type' => 'text', 'control_id' => 'title', 'control_label' => 'Title', 'control_value' => old('title', $link->title), 'control_validation' => 'required autofocus maxlenght='.\App\Link::DD_TITLE_LENGTH])
    @form_input(['input_type' => 'url', 'control_id' => 'url', 'control_label' => 'URL', 'control_value' => old('url', $link->url), 'control_validation' => 'required maxlenght='.\App\Link::DD_URL_LENGTH])
    @form_input(['input_type' => 'number', 'control_id' => 'sort_order', 'control_label' => 'Sort Order', 'control_value' => old('url', $link->sort_order), 'control_validation' => 'min=0 max='.\App\Link::DD_SORT_ORDER_MAX, 'control_size' => 'm'])
    @can('create', get_class($holdingModel)) @form_submit @endcan
</form>

@endsection
