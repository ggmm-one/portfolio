<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\ResourceCapacity;
use Illuminate\Http\Request;
use App\Libraries\DateHelper;

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
            ->where('resources.pid', '=', $route->resource->pid)
            ->whereDate('start', '<', $end)->whereDate('end', '>', $start);
        if ($route->resource_capacity) {
            $query->where('resource_capacities.pid', '<>', $route->resource_capacity->pid);
        }
        return !$query->exists();
    }

    public function message()
    {
        return 'Date interval overlaps with an existing interval';
    }
}
