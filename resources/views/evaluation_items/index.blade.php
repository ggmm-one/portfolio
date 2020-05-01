@extends('layouts.frame_app')

@section('pagetitle', __('Evaluation Items'))

@include('layouts.navbars.admin')

@section('content')

@include('inc.flash_msg')

<nav class="navbar navbar-light bg-light">
    <span class="navbar-brand">{{ __('Evaluation Items') }}</span>
    <a href="{{ route('evaluation_items.create') }}" class="btn btn-primary">{{ __('Add') }}</a>
</nav>

<table class="table">
    <thead>
        <tr>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Weight') }}</th>
            <th>{{ __('Actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @each('evaluation_items.index_item', $evaluationItems, 'evaluationItem', 'evaluation_items.index_item_empty')
    </tbody>
</table>
@if($sum != 100)
<div class="alert alert-warning" role="alert">{{ __('Weights sum is: ').$sum }}</div>
@endif

@endsection
