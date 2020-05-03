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
        return [
                'content' => Rule::required()->string(1, Comment::DD_CONTENT_LENGTH)->get(),
            ];
    }
}
