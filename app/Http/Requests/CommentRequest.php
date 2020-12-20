<?php

namespace App\Http\Requests;

use App\Comment;
use TiMacDonald\Validation\Rule;

final class CommentRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
                'content' => Rule::required()->string(1, Comment::DD_CONTENT_LENGTH)->get(),
            ];
    }
}
