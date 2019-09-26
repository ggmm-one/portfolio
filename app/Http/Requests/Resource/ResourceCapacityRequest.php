<?php

namespace App\Http\Requests\Resource;

use Illuminate\Foundation\Http\FormRequest;
use App\Model;
use App\ResourceCapacity;
use TiMacDonald\Validation\Rule;
use App\Rules\NoIntervalOverlap;
use App\Libraries\DateHelper;

class ResourceCapacityRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'start' => Rule::required()->after(Model::DD_DATE_MIN)->before(Model::DD_DATE_MAX)->get(),
            'end' => Rule::required()->after(Model::DD_DATE_MIN)->before(Model::DD_DATE_MAX)->after('start')->add(new NoIntervalOverlap($this))->get(),
            'type' => Rule::required()->in(array_keys(ResourceCapacity::TYPES))->get(),
            'quantity' => Rule::required()->integer(0, ResourceCapacity::DD_QUANTITY_MAX)->get()
        ];
    }

    public function validated()
    {
        $validated = parent::validated();
        $validated['start'] = DateHelper::setDateToMonth($validated['start']);
        $validated['end'] = DateHelper::setDateToMonth($validated['end']);
        return $validated;
    }
}
