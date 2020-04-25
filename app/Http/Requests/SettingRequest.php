<?php

namespace App\Http\Requests;

use App\Setting;
use Illuminate\Foundation\Http\FormRequest;
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
            'evaluation_max' => Rule::required()->integer(0, Setting::DD_EVALUATION_MAX)->get(),
        ];
    }
}
