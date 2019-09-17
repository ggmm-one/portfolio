@extends('layouts.sections.portfolios')

@section('pagetitle', __('Portfolio Comments'))
@section('bodyid', 'app-portfolios-portfolio-comment-index')

@section('subcontent')

    @include('comments.inc.index')

@endsection
