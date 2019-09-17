<?php

namespace App\Traits;

use Illuminate\Validation\ValidationException;

trait CheckBeforeDeletes
{
    public function deleteIfNotReferenced()
    {
        $this->checkBeforeDeleting();
        if(isset($this->checkBeforeDeleting)) {
            foreach ($this->checkBeforeDeleting as $item) {
                if ($item[0]::where($item[1], $this->id)->whereNull($this->getDeletedAtColumn())->exists()) {
                    throw ValidationException::withMessages(['check_before_deleting' => $item[2]]);
                }
            }
        }
        $this->delete();
    }

    protected function checkBeforeDeleting()
    {
        //
    }
}
