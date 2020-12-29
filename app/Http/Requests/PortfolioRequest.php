<?php

namespace App\Http\Requests;

use App\Portfolio;
use TiMacDonald\Validation\Rule;

final class PortfolioRequest extends BaseFormRequest
{
    public function rules()
    {
        $rules = [
            'name' => Rule::required()->string(1, Portfolio::DD_NAME_LENGTH)->get(),
            'description' => Rule::nullable()->string(1, Portfolio::DD_DESCRIPTION_LENGTH)->get(),
        ];
        if (! $this->portfolio || ! $this->portfolio->isRoot()) {
            $rules['parent_id'] = Rule::required()->get();
        }

        return $rules;
    }
}
