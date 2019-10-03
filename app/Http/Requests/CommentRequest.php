<?php

namespace App\Http\Requests;

use App\Comment;
use Illuminate\Foundation\Http\FormRequest;
use TiMacDonald\Validation\Rule;

class CommentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if ($this->routeIs('*edit') || $this->routeIs('*destroy')) {
            return [];
        } else {
            return [
                'content' => Rule::required()->string(1, Comment::DD_CONTENT_LENGTH)->get(),
            ];
        }
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $this->validateModelComment();
        });
    }

    public function validateModelComment()
    {
        if ($this->routeIs('*store')) {
            return;
        }
        $model = $this->resource ?: $this->portfolio_unit ?: $this->project ?: null;
        if ($model == null || $this->comment->commentable_id != $model->id || $this->comment->commentable_type != $model::MORPH_SHORT_NAME) {
            abort(404);
        }
    }
}
