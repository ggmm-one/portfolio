@extends('layouts.frame_app')

@section('pagetitle', 'Resource Comments')
@section('bodyid', 'app-resources-comments-index')

@include('resources.inc.section_nav_bar')

@section('content')

    @include('resources.inc.resources_header')

    @include('comments.inc.index')

@endsection
