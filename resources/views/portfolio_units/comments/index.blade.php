@extends('layouts.frame_app')

@section('pagetitle', 'Portfolio Comments')
@section('bodyid', 'app-portfolios-portfolio-comment-index')

@section('content')

    @include('portfolios.inc.portfolios_header')

    @include('comments.inc.index')

@endsection
