@extends('layouts.frame_app')

@section('pagetitle', 'Project Comments')
@section('bodyid', 'app-projects-comments-index')

@section('content')

    @include('inc.flash_msg')

    @include('projects.inc.projects_header')

    @include('comments.inc.index')

@endsection
