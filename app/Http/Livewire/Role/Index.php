<?php

namespace App\Http\Livewire\Role;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Custom\Traits\ConstructsPages;
use App\Custom\Traits\WithDataTable;
use App\Custom\Services\OperationLogService;

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
        $role = Role::findOrFail($id);

        $this->authorize('delete', $role);

        DB::transaction(function() use ($role) {
            app()->make(OperationLogService::class)->create($role, 2);
            $role->delete();
        });

        return redirect()->route($this->mi_code)->with('success', __('The record has been deleted.'));
    }

    public function render()
    {
        $query = Role::query();

        foreach ($this->searchColumns as $column => $value) {
            if (!empty($value)) {
                if ($column == 'title') {
                    $query->where($column, 'LIKE', '%' . $value . '%');
                }
            }
        }

        $query->orderBy($this->sortBy ?? 'id', $this->sortDirection ?? 'desc');

        return view($this->view, [
            'roles' => $query->paginate($this->rpp)
        ])->layoutData($this->only([
            'menu_data',
        ]));
    }
}
