<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentRequest;
use App\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ResourceCommentController extends Controller
{
    public function index(Resource $resource)
    {
        $this->authorize('view', $resource);

        return $this->view($resource);
    }

    public function store(CommentRequest $request, Resource $resource)
    {
        $this->authorize('create', $resource);
        $comment = new Comment($request->validated());
        $comment->user_id = Auth::id();
        $resource->comments()->save($comment);

        return Redirect::route('resources.comments.index', ['resource' => $resource->pid]);
    }

    public function edit(CommentRequest $request, Resource $resource, Comment $comment)
    {
        $this->authorize('view', $resource);

        return $this->view($resource, $comment);
    }

    private function view(Resource $resource, Comment $comment = null)
    {
        $data = ['resource' => $resource];
        $data['comments'] = Comment::with('author:id,pid,name')->where('commentable_type', Resource::MORPH_SHORT_NAME)->where('commentable_id', $resource->id)->latest()->get();
        if ($comment != null) {
            $data['editComment'] = $comment;
        }

        return view('resources.resources.comments.index', $data);
    }

    public function update(CommentRequest $request, Resource $resource, Comment $comment)
    {
        $this->authorize('update', $resource);
        $comment->update($request->validated());

        return Redirect::route('resources.comments.index', ['resource' => $resource->pid]);
    }

    public function destroy(CommentRequest $request, Resource $resource, Comment $comment)
    {
        $this->authorize('delete', $resource);
        $comment->delete();

        return Redirect::route('resources.comments.index', ['resource' => $resource->pid]);
    }
}
