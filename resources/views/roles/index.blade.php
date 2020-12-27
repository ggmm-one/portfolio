@extends('layouts.base')

@include('layouts.navbars.primary.main')
@include('layouts.navbars.secondary.admin')

@section('content')

    <div class="card">
        <div class="card-header">
            <span>{{ __('Roles') }}</span>
            @can('create', App\Role::class) <a href="{{ route('roles.create') }}" class="btn btn-primary float-right">{{ __('Add') }}</a>
            @endcan
        </div>


        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @each('roles.index_item', $roles, 'role', 'roles.index_item_empty')
            </tbody>
        </table>
    </div>

@endsection
