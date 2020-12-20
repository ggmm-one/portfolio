<?php

namespace App\Http\Requests;

use TiMacDonald\Validation\Rule;

final class ProjectConstraintRequest extends BaseFormRequest
{
    public function rules()
    {
        if ($this->routeIs('*store')) {
            return ['hashid' => Rule::required()->exists('projects')->get()];
        } elseif ($this->routeIs('*update')) {
            return [
                'start_after' => Rule::nullable()->date()->get(),
                'end_before' => Rule::nullable()->date()->get(),
            ];
        }
    }
}
