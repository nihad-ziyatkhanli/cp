<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Custom\Traits\ConstructsPages;
use App\Custom\Traits\ListensToEvents;
use App\Custom\Services\OperationLogService;
// use Illuminate\Support\Facades\Validator;

class Update extends Component
{
    use ConstructsPages;
    use ListensToEvents; // To react to select box value update.

    public User $user;
    public $password;
    public $roleIds; // multi select value
    public $roleIdsConf; // multi select config
    public $assignables;

    protected $rules;
    protected $listeners = ['selected']; // To react to select box value update.

    public function mount()
    {
        $this->user = User::with('roles')->findOrFail(request()->route('id'));
        $this->roleIds = $this->user->roles->pluck('id')->toArray();
        $this->assignables = auth()->user()->highestRole()->assignables($this->user->roles);
        $this->roleIdsConf = [
            'name' => 'roleIds',
            'text' => 'title',
            'values_init' => $this->roleIds,
            'models' => $this->assignables,
        ];
    }

    public function booted()
    {
        $this->authorize('update', $this->user);

        $this->rules = [
            'user.name' => 'bail|required|string|max:25|unique:users,name,'.$this->user->id,
            'user.email' => 'bail|required|string|max:25|email|unique:users,email,'.$this->user->id,
            'password' => 'bail|nullable|string|min:8',
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

        // Example to load multi select with new options from db. For no options, use 'models' => []

        //    $this->emit('roleIds', [
        //        'name' => 'roleIds',
        //        'text' => 'title',
        //        'callback' => [\App\Models\Role::class, 'orderBy'],
        //        'params' => ['title', 'asc'],
        //    ]);

    }
    */

    public function save()
    {
        $this->validate();

        $roleIdsOriginal = $this->user->roles->pluck('id')->toArray();
        sort($this->roleIds);
        sort($roleIdsOriginal);

        if ($this->user->isClean() && empty($this->password) && $this->roleIds == $roleIdsOriginal) {
            return;
        }

        DB::transaction(function() {
            $this->user->password = $this->password;
            $this->user->save();
            $this->user->roles()->sync($this->roleIds);
            $this->user->load('roles');

            app()->make(OperationLogService::class)->create($this->user, 1);
        });

        return redirect()->route($this->mi_code)->with('success', __('The record has been updated.'));
    }

    public function render()
    {
        return view($this->view)->layoutData($this->only([
            'menu_data',
        ]));
    }
}
