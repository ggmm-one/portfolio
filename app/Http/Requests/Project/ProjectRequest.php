<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;
use TiMacDonald\Validation\Rule;
use App\Project;
use App\Model;
use App\Libraries\DateHelper;

class ProjectRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => Rule::required()->string(1, Project::DD_NAME_LENGTH)->get(),
            'code' => Rule::nullable()->string(1, Project::DD_CODE_LENGTH)->get(),
            'portfolio_unit_pid' => Rule::required()->get(),
            'type' => Rule::required()->in(array_keys(Project::TYPES))->get(),
            'status' => Rule::required()->in(array_keys(Project::STATUS))->get(),
            'start' => Rule::nullable()->after(Model::DD_DATE_MIN)->before(Model::DD_DATE_MAX)->get(),
            'duration' => Rule::nullable()->integer()->min(1)->max(Project::DD_DURATION_MAX)->get(),
            'description' => Rule::nullable()->string(1, Project::DD_DESCRIPTION_LENGTH)->get()
        ];
    }

    public function validated()
    {
        $validated = parent::validated();
        $validated['start'] = DateHelper::setDateToMonth($validated['start']);
        return $validated;
    }
}
