<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;

class ResourceAllocationService
{
    public function complete(&$allocations)
    {
        if ($allocations->isEmpty()) {
            return $allocations;
        }

        $complete = new Collection();
        $alloc = $allocations[0];
        $duration = $alloc->project->duration;

        while ($alloc != null) {
            for ($i = 1; $i <= $duration; $i++) {
                if ($alloc->month == $i) {
                    $complete[] = $alloc;
                    $alloc = $allocations->isEmpty() ? $alloc : $allocations->shift();
                } else {
                    $new = $alloc->replicate();
                    $new->month = $i;
                    $new->quantity = 0;
                    $complete[] = $new;
                }
            }
            $alloc = $allocations->shift();
        }

        return $complete;
    }
}
