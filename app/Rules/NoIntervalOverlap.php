<?php

namespace App\Rules;

use App\Libraries\DateHelper;
use App\ResourceCapacity;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class NoIntervalOverlap implements Rule
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function passes($attribute, $value)
    {
        $route = $this->request->route();
        $start = DateHelper::setDateToMonth($this->request->input('start'));
        $end = DateHelper::setDateToMonth($this->request->input('end'));
        $query = ResourceCapacity::join('resources', 'resources.id', '=', 'resource_capacities.resource_id')
            ->where('resources.id', '=', $route->resource->id)
            ->whereDate('start', '<', $end)->whereDate('end', '>', $start);
        if ($route->resource_capacity) {
            $query->where('resource_capacities.id', '<>', $route->resource_capacity->id);
        }

        return ! $query->exists();
    }

    public function message()
    {
        return 'Date interval overlaps with an existing interval';
    }
}
