<?php

namespace App\Http\Requests;

use App\EvaluationScore;
use App\Setting;
use TiMacDonald\Validation\Rule;

final class EvaluationScoreRequest extends BaseFormRequest
{
    public function rules()
    {
        if ($this->routeIs('*edit')) {
            return [];
        } else {
            $evaluationMax = Setting::first()->value('evaluation_max');

            return [
                'score' => Rule::required()->integer(1, $evaluationMax)->get(),
                'description' => Rule::required()->string(1, EvaluationScore::DD_DESCRIPTION_LENGTH)->get(),
            ];
        }
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $this->validateRelationship();
        });
    }

    private function validateRelationship()
    {
        abort_if($this->project->id != $this->evaluation_score->project_id, 400);
    }
}
