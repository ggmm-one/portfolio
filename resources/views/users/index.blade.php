@extends('layouts.base')

@include('layouts.navbars.primary.main')
@include('layouts.navbars.secondary.admin')

@section('content')

    <div class="card">
        <div class="card-header">
            <span>{{ __('Users') }}</span>
            @can('create', App\User::class) <a href="{{ route('users.create') }}" class="btn btn-primary">{{ __('Add') }}</a> @endcan
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @each('users.index_item', $users, 'user', 'users.index_item_empty')
            </tbody>
        </table>
    </div>

@endsection
