@extends('layouts.frame_app')

@section('pagetitle', 'Comments')

@section('content')

@includeIf('layouts.navbars.'.$holdingModel->getTable())

@includeIf('layouts.headers.'.$holdingModel->getTable())

@includeWhen(!isset($editComment) && auth()->user()->can('create', get_class($holdingModel)), 'comments.inc.form')

<hr>

@if ($comments->isEmpty())
@include('comments.inc.index_item_empty')
@else
@foreach ($comments as $comment)
@if (isset($editComment) && $comment->id == $editComment->id && auth()->user()->can('update', $comment))
@include('comments.inc.edit')
@else
@include('comments.inc.index_item')
@endif
@endforeach
@endif

@endsection
