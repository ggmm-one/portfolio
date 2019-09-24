<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Setting;
use TiMacDonald\Validation\Rule;

class SettingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'evaluation_max' => Rule::required()->integer(0, Setting::DD_EVALUATION_MAX)->get()
        ];
    }
}
