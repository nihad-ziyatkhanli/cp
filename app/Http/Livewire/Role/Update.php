<?php

namespace App\Http\Livewire\Role;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Custom\Traits\ConstructsPages;
use App\Custom\Services\OperationLogService;

class Update extends Component
{
    use ConstructsPages;

    public Role $role;
    public $checkAll = false;

    protected $rules;

    public function mount()
    {
        $this->role = Role::findOrFail(request()->route('id'));
    }

    public function booted()
    {
        $this->authorize('update', $this->role);

        $this->rules = [
            'role.title' => 'bail|required|string|max:25|unique:roles,title,'.$this->role->id,
            'role.code' => 'bail|required|string|max:25|unique:roles,code,'.$this->role->id,
            'role.rank' => [
                'bail',
                'required',
                'integer',
                'min:1',
                'max:9999',
                function ($attribute, $value, $fail) {
                    if ($value < auth()->user()->highestRole()->rank) {
                        $fail('The rank must be higher than or equal to your own.');
                    }
                },
            ],
            'role.status' => 'bail|required|boolean',
            'role.permissions' => 'array',
            'role.permissions.*' => 'string',
        ];
    }

    public function updated($name, $value)
    {
        // $this->validateOnly($name);
        $permissions = array_keys(config('cp.permissions'));

        if($name === 'checkAll') {
            $this->role->permissions = $value ? $permissions : [];
        } else {
            $this->role->permissions = array_values(array_intersect($permissions, $this->role->permissions));
        }
    }

    public function save()
    {
        $this->validate();

        if ($this->role->isClean()) {
            return;
        }

        DB::transaction(function() {
            $this->role->save();

            app()->make(OperationLogService::class)->create($this->role, 1);
        });

        return redirect()->to(route('roles'))->with('success', __('The record has been updated.'));
    }

    public function render()
    {
        return view($this->view)->layoutData($this->only([
            'menu_data',
        ]));
    }
}
