<?php

namespace App\Custom\General;

use Livewire\Wireable;

/* Data Transfer Object */
class Proxy implements Wireable
{
    public $properties = [];

    public function __construct($properties)
    {
        $this->properties = $properties;
    }

    public function __isset($name)
    {
        return isset($this->properties[$name]);
    }

    public function __set($name, $value)
    {
        $this->properties[$name] = $value;
    }

    public function __get($name)
    {
        return $this->properties[$name] ?? null;
    }

    public function toLivewire()
    {
        return $this->properties;
    }

    public static function fromLivewire($value)
    {
        return new static($value);
    }
}
