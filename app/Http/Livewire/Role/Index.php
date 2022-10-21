<?php

namespace App\Http\Livewire\Role;

use Livewire\Component;
use App\Models\Role;
use App\Custom\Traits\ConstructsPages;
use App\Custom\Traits\WithDataTable;

class Index extends Component
{
    use ConstructsPages;
    use WithDataTable;

    public $searchColumns = [
        'title' => '',
    ];

    public function booted()
    {
        $this->authorize('read'.'_'.$this->mi_code);
    }

    public function delete($id)
    {
        Role::findOrFail($id)->delete();
        $this->success = 'The record has been deleted.';
    }

    public function render()
    {
        $roles = Role::query();

        foreach ($this->searchColumns as $column => $value) {
            if (!empty($value)) {
                if ($column == 'title') {
                    $roles->where($column, 'LIKE', '%' . $value . '%');
                }
            }
        }

        $roles->orderBy($this->sortBy, $this->sortDirection);

        return view($this->view, [
            'roles' => $roles->paginate($this->rpp)
        ])->layoutData($this->only([
            'mi_title',
            'menu_data',
        ]));
    }
}
