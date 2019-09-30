<?php

namespace App\Http\Requests\Portfolio;

use Illuminate\Foundation\Http\FormRequest;
use TiMacDonald\Validation\Rule;
use App\PortfolioUnit;

class PortfolioUnitRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => Rule::required()->string(1, PortfolioUnit::DD_NAME_LENGTH)->get(),
            'description' => Rule::nullable()->string(1, PortfolioUnit::DD_DESCRIPTION_LENGTH)->get(),
        ];
        if (!$this->portfolio_unit || !$this->portfolio_unit->isRoot()) {
            $rules['type'] = Rule::required()->in(array_keys(PortfolioUnit::TYPES))->get();
            $rules['parent_pid'] = Rule::required()->exists('portfolio_units', 'pid')->get();
        }
        return $rules;
    }
}
