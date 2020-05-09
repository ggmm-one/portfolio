<br>
@if (isset($comment))
<form method="POST" action="{{ route(explode('.', Request::route()->getName())[0].'.comments.update', array_merge(Request::route()->parameters(), compact('comment'))) }}">
    @method('PATCH')
    @else
    <form method="POST" action="{{ route(explode('.', Request::route()->getName())[0].'.comments.store', array_merge(Request::route()->parameters(), compact('comment'))) }}">
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
                    {{ __(isset($comment) ? 'Save' : 'Add') }}
                </button>
            </div>
        </div>
    </form>
