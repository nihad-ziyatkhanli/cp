<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Custom\Traits\ConstructsPages;
use App\Custom\Services\OperationLogService;
// use Illuminate\Support\Facades\Validator;

class Update extends Component
{
    use ConstructsPages;

    public User $user;
    public $password;
    public $role_ids;
    public $assignables;

    protected $role_ids_original;
    protected $rules;

    public function mount()
    {
        $this->user = User::with('roles')->findOrFail(request()->route('id'));
    }

    public function booted()
    {
        $this->authorize('update', $this->user);

        $this->assignables = auth()->user()->highestRole()->assignables($this->user->roles);
        $this->role_ids = $this->role_ids_original = $this->user->roles->pluck('id')->toArray();

        $this->rules = [
            'user.name' => 'bail|required|string|max:25|unique:users,name,'.$this->user->id,
            'user.email' => 'bail|required|string|max:25|email|unique:users,email,'.$this->user->id,
            'password' => 'bail|nullable|string|min:8',
            'role_ids' => 'bail|array',
            'role_ids.*' => [
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

        sort($this->role_ids);
        sort($this->role_ids_original);

        if ($this->user->isClean() && empty($this->password) && $this->role_ids == $this->role_ids_original) {
            return;
        }

        DB::transaction(function() {
            $this->user->password = $this->password;
            $this->user->save();
            $this->user->roles()->sync($this->role_ids);
            $this->user->load('roles');

            app()->make(OperationLogService::class)->create($this->user, 1);
        });

        return redirect()->to(route('users'))->with('success', __('The record has been updated.'));
    }

    public function render()
    {
        return view($this->view)->layoutData($this->only([
            'menu_data',
        ]));
    }
}
