<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use TiMacDonald\Validation\Rule;

class ProjectConstraintRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if ($this->routeIs('*store')) {
            return ['pid' => Rule::required()->exists('projects')->get()];
        } elseif ($this->routeIs('*update')) {
            return [
                'start_after' => Rule::nullable()->date()->get(),
                'end_before' => Rule::nullable()->date()->get()
            ];
        }
    }
}
