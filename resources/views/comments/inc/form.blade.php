@if (isset($comment))
    <form method="POST" action="{{ str_replace('CCOOMMMMEENNTT', $comment->pid, $updateAction) }}">
    @method('PATCH')
@else
    <form method="POST" action="{{ URL::current() }}">
@endif
    @csrf
    <div class="row">
    <div class="col-sm-8 offset-sm-2">
    <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror" required maxlength="{{ App\Comment::DD_CONTENT_LENGTH }}">{{ old('content', $comment->content ?? '') }}</textarea>
        @error('content')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-sm-2">
        <button type="submit" class="btn btn-primary">
            @if (isset($comment)) {{ __('Save') }} @else {{ __('Add') }} @endif
        </button>
    </div>
    </div>
</form>
