@extends('layouts.frame_app')

@section('pagetitle', 'Profile')
@section('bodyid', 'app-profile-show')

@section('content')
<div class="card">
    <div class="card-header">
        {{ $user->name }}
    </div>
    <div class="card-body">
        <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
    </div>
</div>
@endsection
