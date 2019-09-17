@extends('layouts.sections.resources')

@section('pagetitle', __('Resource Comments'))
@section('bodyid', 'app-resources-comments-index')

@section('subcontent')

    @include('resources.resources.inc.header')

    @include('comments.inc.index')

@endsection
