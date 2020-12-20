<?php

namespace App\Http\Requests;

use App\PortfolioUnit;
use TiMacDonald\Validation\Rule;

final class PortfolioUnitRequest extends BaseFormRequest
{
    public function rules()
    {
        $rules = [
            'name' => Rule::required()->string(1, PortfolioUnit::DD_NAME_LENGTH)->get(),
            'description' => Rule::nullable()->string(1, PortfolioUnit::DD_DESCRIPTION_LENGTH)->get(),
        ];
        if (! $this->portfolio_unit || ! $this->portfolio_unit->isRoot()) {
            $rules['type'] = Rule::required()->in(array_keys(PortfolioUnit::TYPES))->get();
            $rules['parent_hashid'] = Rule::required()->get();
        }

        return $rules;
    }
}
