@extends('layouts.sections.projects')

@section('pagetitle', __('Project Comments'))
@section('bodyid', 'app-projects-comments-index')

@section('subcontent')

    @include('comments.inc.index')

@endsection
