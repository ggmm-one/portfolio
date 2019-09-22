<?php

namespace App\Http\Controllers\Portfolio;

use App\Comment;
use App\PortfolioUnit;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PortfolioCommentController extends CommentController
{
    public function index(PortfolioUnit $portfolioUnit)
    {
        return $this->view($portfolioUnit);
    }

    public function store(Request $request, PortfolioUnit $portfolioUnit)
    {
        $comment = new Comment($this->validateValues($request));
        $comment->user_id = Auth::id();
        $portfolioUnit->comments()->save($comment);
        return Redirect::route('portfolios.comments.index', ['portfolio_unit' => $portfolioUnit->pid]);
    }

    public function edit(PortfolioUnit $portfolioUnit, Comment $comment)
    {
        $this->validateModelComment($portfolioUnit, $comment);
        return $this->view($portfolioUnit, $comment);
    }

    private function view(PortfolioUnit $portfolioUnit, Comment $comment = null)
    {
        $data = array();
        $data['portfolioUnit'] = $portfolioUnit;
        $data['comments'] = Comment::with('author:id,pid,name')->where('commentable_type', 'pun')->where('commentable_id', $portfolioUnit->id)->orderBy('created_at', 'DESC')->get();
        $data['editAction'] = route('portfolios.comments.edit', ['portfolio_unit' => $portfolioUnit->pid, 'comment' => 'CCOOMMMMEENNTT']);
        $data['updateAction'] = route('portfolios.comments.update', ['portfolio_unit' => $portfolioUnit->pid, 'comment' => 'CCOOMMMMEENNTT']);
        $data['deleteAction'] = route('portfolios.comments.destroy', ['portfolio_unit' => $portfolioUnit->pid, 'comment' => 'CCOOMMMMEENNTT']);
        if ($comment != null) {
            $data['editComment'] = $comment;
        }

        return view('portfolios.comments.index', $data);
    }

    public function update(Request $request, PortfolioUnit $portfolioUnit, Comment $comment)
    {
        $this->validateModelComment($portfolioUnit, $comment);
        $comment->update($this->validateValues($request));
        return Redirect::route('portfolios.comments.index', ['portfolio_unit' => $portfolioUnit->pid]);
    }

    public function destroy(PortfolioUnit $portfolioUnit, Comment $comment)
    {
        $this->validateModelComment($portfolioUnit, $comment);
        $comment->delete();
        return Redirect::route('portfolios.comments.index', ['portfolio_unit' => $portfolioUnit->pid]);
    }
}
