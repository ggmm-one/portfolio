<div class="card app-comments-card">
    <div class="card-body">
        <p class="card-text"><a name="{{ $comment->pid }}"></a>{!! nl2br(e($comment->content)) !!}</p>
    </div>
    <div class="card-footer bg-light text-right text-muted app-comments-footer">

        @can('update', $comment)
        <span><a href="{{ route('comments.edit', array_merge(Request::route()->parameters(), compact('comment'))) }}">{{ __('Edit') }}</a></span>
        @endcan

        @can('delete', $comment)
        <span>
            <x-delete-model :model="$comment" />
        </span>
        @endcan


        <span title="{{ $comment->author->pid }}">{{ $comment->author->name }}</span>

        <span title="{{ __('Created at: ').$comment->created_at.__(' | Last updated at: ').$comment->updated_at }}">
            {{ $comment->created_at->diffForHumans() }}
            @if ($comment->created_at != $comment->updated_at)
            ({{ 'Edited '. $comment->updated_at->diffForHumans() }})
            @endif
        </span>

    </div>
</div>
