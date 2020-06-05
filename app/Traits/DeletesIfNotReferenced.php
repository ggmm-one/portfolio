<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

trait DeletesIfNotReferenced
{
    public function deleteIfNotReferenced()
    {
        Log::critical('Bunda');
        if (isset($this->checkReferenceBeforeDeleting)) {
            Log::critical('Bunda1');
            foreach ($this->checkReferenceBeforeDeleting as $reference) {
                Log::critical('Bunda2');
                Log::critical($reference, ['e' => $this->{$reference}()->get()]);
                Log::critical($reference, ['e' => $this->{$reference}()->exists()]);
                if ($this->{$reference}()->exists()) {
                    $langKey = 'delete_check.'.$this->getTable().'.'.$reference;
                    throw ValidationException::withMessages($langKey);
                }
            }
        }
        // if (defined('static::CHECK_BEFORE_DELETING')) {
        //     foreach (static::CHECK_BEFORE_DELETING as $item) {
        //         if ($item[0]::where($item[1], $this->id)->whereNull($this->getDeletedAtColumn())->exists()) {
        //             throw ValidationException::withMessages(['check_before_deleting' => $item[2]]);
        //         }
        //     }
        // }
        $this->delete();
    }
}
