<?php

namespace App\Http\Controllers\Project;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProjectCommentController extends Controller
{
    public function index(Project $project)
    {
        $this->authorize('view', $project);

        return $this->view($project);
    }

    public function store(CommentRequest $request, Project $project)
    {
        $this->authorize('create', $project);
        $comment = new Comment($request->validated());
        $comment->user_id = Auth::id();
        $project->comments()->save($comment);

        return Redirect::route('projects.comments.index', ['project' => $project->pid]);
    }

    public function edit(CommentRequest $request, Project $project, Comment $comment)
    {
        $this->authorize('view', $project);

        return $this->view($project, $comment);
    }

    private function view(Project $project, Comment $comment = null)
    {
        $data = ['project' => $project];
        $data['comments'] = Comment::with('author:id,pid,name')->where('commentable_type', Project::MORPH_SHORT_NAME)->where('commentable_id', $project->id)->latest()->get();
        if ($comment != null) {
            $data['editComment'] = $comment;
        }

        return view('projects.comments.index', $data);
    }

    public function update(CommentRequest $request, Project $project, Comment $comment)
    {
        $this->authorize('update', $project);
        $comment->update($request->validated());

        return Redirect::route('projects.comments.index', ['project' => $project->pid]);
    }

    public function destroy(CommentRequest $request, Project $project, Comment $comment)
    {
        $this->authorize('delete', $project);
        $comment->delete();

        return Redirect::route('projects.comments.index', ['project' => $project->pid]);
    }
}
