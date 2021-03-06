<?php

namespace App\Http\Requests;

use App\Libraries\DateHelper;
use App\Model;
use App\ResourceCapacity;
use App\Rules\NoIntervalOverlap;
use TiMacDonald\Validation\Rule;

final class ResourceCapacityRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'start' => Rule::required()->after(Model::DD_DATE_MIN)->before(Model::DD_DATE_MAX)->get(),
            'end' => Rule::required()->after(Model::DD_DATE_MIN)->before(Model::DD_DATE_MAX)->after('start')->add(new NoIntervalOverlap($this))->get(),
            'quantity' => Rule::required()->integer(0, ResourceCapacity::DD_QUANTITY_MAX)->get(),
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
