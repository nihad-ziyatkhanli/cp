<?php

namespace App\Http\Livewire\Role;

use Livewire\Component;
use App\Models\Role;
use App\Custom\Traits\ConstructsPages;

class Delete extends Component
{
    use ConstructsPages;

    public function booted()
    {
        $this->authorize('delete'.'_'.$this->mi_code);
    }

    public function render()
    {
        return view($this->view, [

        ])->layoutData($this->only([
            'mi_title',
            'menu_data',
        ]));
    }
}
