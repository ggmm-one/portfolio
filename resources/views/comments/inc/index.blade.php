@includeWhen(!isset($editComment), 'comments.inc.form')

<hr>

@if ($comments->isEmpty())
    @include('comments.inc.index_item_empty')
@else
    @foreach ($comments as $comment)

        @if (isset($editComment) && $comment->id == $editComment->id)
            @include('comments.inc.edit')
        @else
            @include('comments.inc.index_item')
        @endif
    @endforeach
@endif

@push('bottom')
<script src="/js/delete_dialog.js"></script>
@endpush
