<?php

namespace App\Custom\Traits;

trait ConvertsEmptyStringsToNull
{
    protected $convertEmptyStringsExcept = [
        //
    ];

    public function updatedConvertsEmptyStringsToNull(string $name, $value): void
    {
        if (! is_string($value) || in_array($name, $this->convertEmptyStringsExcept)) {
            return;
        }

        $value = trim($value);
        $value = $value === '' ? null : $value;

        data_set($this, $name, $value);
    }
}
