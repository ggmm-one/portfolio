<?php

namespace App\Http\Controllers\Project;

use App\Comment;
use App\Project;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProjectCommentController extends CommentController
{
    public function index(Project $project)
    {
        return $this->view($project);
    }

    public function store(Request $request, Project $project)
    {
        $comment = new Comment($this->validateValues($request));
        $comment->user_id = Auth::id();
        $project->comments()->save($comment);
        return Redirect::route('projects.comments.index', ['project' => $project->pid]);
    }

    public function edit(Project $project, Comment $comment)
    {
        $this->validateModelComment($project, $comment);
        return $this->view($project, $comment);
    }

    private function view(Project $project, Comment $comment = null)
    {
        $data = array();
        $data['project'] = $project;
        $data['comments'] = Comment::with('author:id,pid,name')->where('commentable_type', Project::MORPH_SHORT_NAME)->where('commentable_id', $project->id)->orderBy('created_at', 'DESC')->get();
        $data['editAction'] = route('projects.comments.edit', ['project' => $project->pid, 'comment' => 'CCOOMMMMEENNTT']);
        $data['updateAction'] = route('projects.comments.update', ['project' => $project->pid, 'comment' => 'CCOOMMMMEENNTT']);
        $data['deleteAction'] = route('projects.comments.destroy', ['project' => $project->pid, 'comment' => 'CCOOMMMMEENNTT']);
        if ($comment != null) {
            $data['editComment'] = $comment;
        }

        return view('projects.comments.index', $data);
    }

    public function update(Request $request, Project $project, Comment $comment)
    {
        $this->validateModelComment($project, $comment);
        $comment->update($this->validateValues($request));
        return Redirect::route('projects.comments.index', ['project' => $project->pid]);
    }

    public function destroy(Project $project, Comment $comment)
    {
        $this->validateModelComment($project, $comment);
        $comment->delete();
        return Redirect::route('projects.comments.index', ['project' => $project->pid]);
    }
}
