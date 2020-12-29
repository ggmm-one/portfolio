<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentRequest;
use App\Model;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(CommentRequest $request)
    {
        $this->authorize('view', $request->holdingModel);

        return $this->view($request->holdingModel);
    }

    public function store(CommentRequest $request)
    {
        $this->authorize('create', $request->holdingModel);

        $comment = new Comment($request->validated());
        $comment->user_id = Auth::id();
        $request->holdingModel->comments()->save($comment);

        return back();
    }

    public function edit(CommentRequest $request)
    {
        $this->authorize('view', $request->holdingModel);

        $editComment = Comment::findOrFailByHashid($request->comment);

        return $this->view($request->holdingModel, $editComment);
    }

    public function update(CommentRequest $request)
    {
        $this->authorize('update', $request->holdingModel);

        Comment::findOrFailByHashid($request->comment)->update($request->validated());

        return $this->view($request->holdingModel);
    }

    public function destroy(CommentRequest $request)
    {
        $this->authorize('delete', $request->holdingModel);

        Comment::findOrFailByHashid($request->comment)->delete();

        return $this->view($request->holdingModel);
    }

    private function view(Model $holdingModel, Comment $editComment = null)
    {
        $comments = Comment::with('author:id,name')->where('commentable_type', $holdingModel::MORPH_SHORT_NAME)->where('commentable_id', $holdingModel->id)->latest()->get();
        $data = compact('holdingModel', 'comments', 'editComment');
        $data['project'] = $holdingModel;
        $data['portfolio'] = $holdingModel;

        return view('comments.index', $data);
    }
}
