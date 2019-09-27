<div class="card app-comments-card">
    <div class="card-body">
        <p class="card-text"><a name="{{ $comment->pid }}"></a>{!! nl2br(e($comment->content)) !!}</p>
    </div>
    <div class="card-footer bg-light text-right text-muted app-comments-footer">

        @if (auth()->user()->can('create', $parentModel))
            <span><a href="{{ str_replace('CCOOMMMMEENNTT', $comment->pid, $editAction).'#'.$comment->pid}}">{{ __('Edit') }}</a></span>
        @endif

        @if (auth()->user()->can('update', $parentModel))
            <span>
                <a href="#" class="app-js-delete-btn" data-delete-form-id="delete-form-{{ $comment->pid }}">{{ __('Delete') }}</a>
                <form id="delete-form-{{ $comment->pid }}" action="{{ str_replace('CCOOMMMMEENNTT', $comment->pid, $deleteAction) }}" method="POST" style="display: none;">
                    @method('DELETE')
                    @csrf
                </form>
            </span>
        @endif
        

        <span><a href="{{ route('profile.show', ['user' => $comment->author->pid])}}">{{ $comment->author->name }}</a></span>

        <span title="{{ __('Created at: ').$comment->created_at.__(' | Last updated at: ').$comment->updated_at }}">
            {{ $comment->updated_at->diffForHumans() }}
        </span>

    </div>
</div>
