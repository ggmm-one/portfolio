@extends('layouts.base')

@include('layouts.navbars.primary.main')

@includeWhen(isset($portfolio), 'layouts.navbars.tertiary.portfolios')
@includeWhen(isset($resource), 'layouts.navbars.secondary.resources')
@includeWhen(isset($resource), 'layouts.navbars.tertiary.resources')

@section('content')

    @if ($comments->isEmpty())
        @include('comments.index_item_empty')
    @else
        @foreach ($comments as $comment)
            @include('comments.index_item')
        @endforeach
    @endif

@endsection
