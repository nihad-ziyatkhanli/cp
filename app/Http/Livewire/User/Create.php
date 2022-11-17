<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Custom\Traits\ConstructsPages;
use App\Custom\Traits\ListensToEvents;
use App\Custom\Services\OperationLogService;
// use Illuminate\Support\Facades\Validator;

class Create extends Component
{
    use ConstructsPages;
    use ListensToEvents;

    public User $user;
    public $password;
    public $roleIds = []; // multi select value
    public $roleIdsConf; // multi select config
    public $assignables;

    protected $rules;
    protected $listeners = ['selected'];

    public function mount()
    {
        $this->user = new User;
        $this->assignables = auth()->user()->highestRole()->assignables();
        $this->roleIdsConf = [
            'name' => 'roleIds',
            'text' => 'title',
            'values_init' => $this->roleIds,
            'models' => $this->assignables,
        ];
    }

    public function booted()
    {
        $this->authorize('create'.'_'.$this->mi_code);

        $this->rules = [
            'user.name' => 'bail|required|string|max:25|unique:users,name',
            'user.email' => 'bail|required|string|max:25|email|unique:users,email',
            'password' => 'bail|required|string|min:8',
            'roleIds' => 'bail|array',
            'roleIds.*' => [
                'bail',
                'integer',
                function ($attribute, $value, $fail) {
                    if ($this->assignables->doesntContain('id', $value)) {
                        $fail(__('The role is invalid.'));
                    }
                },
            ],
            'user.status' => 'bail|required|boolean',
        ];
    }

    /*
    public function updated($name, $value)
    {
        $this->validateOnly($name);
    }
    */

    public function save()
    {
        $this->validate();

        DB::transaction(function() {
            $this->user->password = $this->password;
            $this->user->save();
            $this->user->roles()->sync($this->roleIds);
            $this->user->load('roles');

            app()->make(OperationLogService::class)->create($this->user, 0);
        });

        return redirect()->route($this->mi_code)->with('success', __('A new record has been added.'));
    }

    public function render()
    {
        return view($this->view)->layoutData($this->only([
            'menu_data',
        ]));
    }
}
