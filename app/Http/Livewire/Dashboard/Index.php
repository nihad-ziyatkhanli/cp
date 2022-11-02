<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Role;
use App\Models\User;
use App\Custom\Traits\ConstructsPages;

class Index extends Component
{
    use ConstructsPages;

    public function boot()
    {

    }

    public function render()
    {
        return view($this->view, [

        ])->layoutData($this->only([
            'menu_data',
        ]));
    }
}
