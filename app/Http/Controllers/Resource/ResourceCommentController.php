<?php

namespace App\Http\Controllers\Resource;

use App\Resource;
use App\Comment;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ResourceCommentController extends CommentController
{
    public function index(Resource $resource)
    {
        return $this->view($resource);
    }

    public function store(Request $request, Resource $resource)
    {
        $comment = new Comment($this->validateValues($request));
        $comment->user_id = Auth::id();
        $resource->comments()->save($comment);
        return Redirect::route('resources.comments.index', ['resource' => $resource->pid]);
    }

    public function edit(Resource $resource, Comment $comment)
    {
        $this->validateModelComment($resource, $comment);
        return $this->view($resource, $comment);
    }

    private function view(Resource $resource, Comment $comment = null)
    {
        $data = array();
        $data['resource'] = $resource;
        $data['comments'] = Comment::with('author:id,pid,name')->where('commentable_type', Resource::MORPH_SHORT_NAME)->where('commentable_id', $resource->id)->orderBy('created_at', 'DESC')->get();
        $data['editAction'] = route('resources.comments.edit', ['resource' => $resource->pid, 'comment' => 'CCOOMMMMEENNTT']);
        $data['updateAction'] = route('resources.comments.update', ['resource' => $resource->pid, 'comment' => 'CCOOMMMMEENNTT']);
        $data['deleteAction'] = route('resources.comments.destroy', ['resource' => $resource->pid, 'comment' => 'CCOOMMMMEENNTT']);
        if ($comment != null) $data['editComment'] = $comment;

        return view('resources.comments.index', $data);
    }

    public function update(Request $request, Resource $resource, Comment $comment)
    {
        $this->validateModelComment($resource, $comment);
        $comment->update($this->validateValues($request));
        return Redirect::route('resources.comments.index', ['resource' => $resource->pid]);
    }

    public function destroy(Resource $resource, Comment $comment)
    {
        $this->validateModelComment($resource, $comment);
        $comment->delete();
        return Redirect::route('resources.comments.index', ['resource' => $resource->pid]);
    }
}
