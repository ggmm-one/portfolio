<?php

namespace App\Http\Requests;

use App\EvaluationItem;
use Illuminate\Foundation\Http\FormRequest;
use TiMacDonald\Validation\Rule;

class EvaluationItemRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => Rule::required()->string(1, EvaluationItem::DD_NAME_LENGTH)->get(),
            'instructions' => Rule::nullable()->string(1, EvaluationItem::DD_INSTRUCTIONS_LENGTH)->get(),
            'weight' => Rule::required()->integer(1, EvaluationItem::DD_WEIGHT_MAX)->get(),
            'sort_order' => Rule::required()->integer(0, EvaluationItem::DD_SORT_ORDER_MAX)->get(),
        ];
    }
}
