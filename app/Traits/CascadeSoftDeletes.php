<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\SoftDeletes;

trait CascadeSoftDeletes
{
    use SoftDeletes {
        SoftDeletes::runSoftDelete as laravelRunSoftDelete;
    }

    /**
     * Perform the actual delete query on this model instance.
     *
     * Overwrites framework's version by using a given timestamp,
     * instead of generating its own inside the method.
     *
     * @return void
     */
    public function runSoftDelete($time = null)
    {
        if ($time == null) {
            $time = $this->freshTimestamp();
        }

        if (isset($this->cascadeDelete)) {
            foreach ($this->cascadeDelete as $models) {
                $this->{$models}->each(function ($model, $key) use ($time) {
                    $model->runSoftDelete($time);
                });
            }
        }

        $query = $this->setKeysForSaveQuery($this->newModelQuery());

        $columns = [$this->getDeletedAtColumn() => $this->fromDateTime($time)];

        $this->{$this->getDeletedAtColumn()} = $time;

        if ($this->timestamps && ! is_null($this->getUpdatedAtColumn())) {
            $this->{$this->getUpdatedAtColumn()} = $time;

            $columns[$this->getUpdatedAtColumn()] = $this->fromDateTime($time);
        }

        $query->update($columns);

        $this->syncOriginalAttributes(array_keys($columns));
    }
}
