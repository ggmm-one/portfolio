<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentRequest;
use App\PortfolioUnit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PortfolioCommentController extends Controller
{
    public function index(PortfolioUnit $portfolioUnit)
    {
        $this->authorize('view', $portfolioUnit);

        return $this->view($portfolioUnit);
    }

    public function store(CommentRequest $request, PortfolioUnit $portfolioUnit)
    {
        $this->authorize('create', $portfolioUnit);
        $comment = new Comment($request->validated());
        $comment->user_id = Auth::id();
        $portfolioUnit->comments()->save($comment);

        return Redirect::route('portfolios.comments.index', ['portfolio_unit' => $portfolioUnit->pid]);
    }

    public function edit(CommentRequest $request, PortfolioUnit $portfolioUnit, Comment $comment)
    {
        $this->authorize('view', $portfolioUnit);

        return $this->view($portfolioUnit, $comment);
    }

    private function view(PortfolioUnit $portfolioUnit, Comment $comment = null)
    {
        $data = ['portfolioUnit' => $portfolioUnit];
        $data['comments'] = Comment::with('author:id,pid,name')->where('commentable_type', 'pun')->where('commentable_id', $portfolioUnit->id)->latest()->get();
        if ($comment != null) {
            $data['editComment'] = $comment;
        }

        return view('portfolios.comments.index', $data);
    }

    public function update(CommentRequest $request, PortfolioUnit $portfolioUnit, Comment $comment)
    {
        $this->authorize('update', $portfolioUnit);
        $comment->update($request->validated());

        return Redirect::route('portfolios.comments.index', ['portfolio_unit' => $portfolioUnit->pid]);
    }

    public function destroy(CommentRequest $request, PortfolioUnit $portfolioUnit, Comment $comment)
    {
        $this->authorize('delete', $portfolioUnit);
        $comment->delete();

        return Redirect::route('portfolios.comments.index', ['portfolio_unit' => $portfolioUnit->pid]);
    }
}
