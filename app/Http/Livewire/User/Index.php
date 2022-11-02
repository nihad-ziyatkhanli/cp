<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Custom\Traits\ConstructsPages;
use App\Custom\Traits\WithDataTable;
use App\Custom\Services\OperationLogService;

class Index extends Component
{
    use ConstructsPages;
    use WithDataTable;

    public $searchColumns = [
        'name' => '',
    ];

    public function booted()
    {
        $this->authorize('read'.'_'.$this->mi_code);
    }

    public function delete($id)
    {
        $user = User::withCount(User::restrictedBy())->findOrFail($id);

        $this->authorize('delete', $user);

        DB::transaction(function() use ($user) {
            $user->delete();

            app()->make(OperationLogService::class)->create($user, 2);
        });

        return redirect()->to(route($this->mi_code))->with('success', __('The record has been deleted.'));
    }

    public function render()
    {
        $query = User::with('roles')->withCount(User::restrictedBy());

        foreach ($this->searchColumns as $column => $value) {
            if (!empty($value)) {
                if ($column == 'name') {
                    $query->where($column, 'LIKE', '%' . $value . '%');
                }
            }
        }

        $query->orderBy($this->sortBy ?? 'id', $this->sortDirection ?? 'desc');

        return view($this->view, [
            'users' => $query->paginate($this->rpp)
        ])->layoutData($this->only([
            'menu_data',
        ]));
    }
}
