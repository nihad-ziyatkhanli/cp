<?php

namespace App\Custom\Traits;

trait TrimsStrings
{
    protected $trimsExcept = [
        //
    ];

    public function updatedTrimsStrings(string $name, $value): void
    {
        if (! is_string($value) || in_array($name, $this->trimsExcept)) {
            return;
        }

        $value = trim($value);
        $value = $value === '' ? null : $value;

        data_set($this, $name, $value);
    }
}
