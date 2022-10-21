<?php

namespace App\Custom\Services;

use App\Custom\Helpers\Helper;
use App\Models\User;

class UserService
{
    /* */

    public function __construct(
        private User $user
    ) {}
}
