<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TiMacDonald\Validation\Rule;
use App\Comment;
use Illuminate\Database\Eloquent\Model;

abstract class CommentController extends Controller
{
    protected function validateValues(Request $request)
    {
        return $request->validate([
            'content' => Rule::required()->string(1, Comment::DD_CONTENT_LENGTH)->get()
        ]);
    }

    protected function validateModelComment(Model $model, Comment $comment)
    {
        if ($comment->commentable_id != $model->id
            || $comment->commentable_type != $model::MORPH_SHORT_NAME) {
            abort(404);
        }
    }
}
