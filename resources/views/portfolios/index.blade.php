@extends('layouts.base')

@include('layouts.navbars.primary.main')

@section('content')

    <div class="card">
        <div class="card-header">
            <span>{{ __('Portfolios') }}</span>
            @can('create', App\Portfolio::class) <a href="{{ route('portfolios.create') }}" class="btn btn-primary">{{ __('Add') }}</a> @endcan
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('Component') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @each('portfolios.index_item', $portfolios, 'portfolio', 'portfolios.index_item_empty')
            </tbody>
        </table>
    </div>

@endsection
