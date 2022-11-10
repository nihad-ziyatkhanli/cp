<?php

namespace App\Custom\Traits;

trait ListensToEvents
{
    public function selected($arr)
    {
        $this->{$arr[0]} = $arr[1];
    }
}
