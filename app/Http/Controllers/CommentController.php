<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentRequest;
use App\Model;
use App\PortfolioUnit;
use App\Project;
use App\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $holdingModel = $this->getHoldingModel($request);
        $this->authorize('view', $holdingModel);

        return $this->view($holdingModel);
    }

    public function store(CommentRequest $request)
    {
        $holdingModel = $this->getHoldingModel($request);
        $this->authorize('create', $holdingModel);
        $comment = new Comment($request->validated());
        $comment->user_id = Auth::id();
        $holdingModel->comments()->save($comment);

        return back();
    }

    public function edit(Request $request)
    {
        $holdingModel = $this->getHoldingModel($request);
        $this->authorize('view', $holdingModel);
        $editComment = Comment::where('pid', $request->comment)->firstOrFail();

        return $this->view($holdingModel, $editComment);
    }

    public function update(CommentRequest $request)
    {
        $holdingModel = $this->getHoldingModel($request);
        $this->authorize('update', $holdingModel);
        Comment::where('pid', $request->comment)->firstOrFail()->update($request->validated());

        return $this->view($holdingModel);
    }

    public function destroy(Request $request)
    {
        $holdingModel = $this->getHoldingModel($request);
        $this->authorize('delete', $holdingModel);
        Comment::where('pid', $request->comment)->firstOrFail()->delete();

        return $this->view($holdingModel);
    }

    private function view(Model $holdingModel, Comment $editComment = null)
    {
        $comments = Comment::with('author:id,pid,name')->where('commentable_type', $holdingModel::MORPH_SHORT_NAME)->where('commentable_id', $holdingModel->id)->latest()->get();
        $data = compact('holdingModel', 'comments', 'editComment');
        $data[Str::camel(Str::singular($holdingModel->getTable()))] = $holdingModel;

        return view('comments.index', $data);
    }

    private function getHoldingModel(Request $request)
    {
        $model = null;
        $prefix = $request->route()->getPrefix();

        if (Str::startsWith($prefix, '/resources')) {
            $model = Resource::where('pid', $request->resource)->firstOrFail();
        } elseif (Str::startsWith($prefix, '/portfolio_units')) {
            $model = PortfolioUnit::where('pid', $request->portfolio_unit)->firstOrFail();
        } elseif (Str::startsWith($prefix, '/projects')) {
            $model = Project::where('pid', $request->project)->firstOrFail();
        }

        return $model;
    }
}
