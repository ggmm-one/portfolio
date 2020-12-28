@extends('layouts.base')


@include('layouts.navbars.primary.main')
@include('layouts.navbars.secondary.admin')

@section('content')

    <div class="card">
        <div class="card-header">
            <span>{{ __('Evaluation Items') }}</span>
            <a href="{{ route('evaluation_items.create') }}" class="btn btn-primary">{{ __('Add') }}</a>
        </div>


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
        @if ($sum != 100)
            <div class="alert alert-warning" role="alert">{{ __('Weights sum is: ') . $sum }}</div>
        @endif
    </div>

@endsection
