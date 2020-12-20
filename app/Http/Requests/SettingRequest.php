<?php

namespace App\Http\Requests;

use App\Setting;
use TiMacDonald\Validation\Rule;

final class SettingRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'evaluation_max' => Rule::required()->integer(0, Setting::DD_EVALUATION_MAX)->get(),
        ];
    }
}
