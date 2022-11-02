<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Custom\Traits\ConstructsPages;
use App\Custom\Services\OperationLogService;
// use Illuminate\Support\Facades\Validator;

class Create extends Component
{
    use ConstructsPages;

    public User $user;
    public $password;
    public $role_ids = [];
    public $assignables;

    protected $rules;

    public function mount()
    {
        $this->user = new User;
    }

    public function booted()
    {
        $this->authorize('create'.'_'.$this->mi_code);

        $this->assignables = auth()->user()->highestRole()->assignables();

        $this->rules = [
            'user.name' => 'bail|required|string|max:25|unique:users,name',
            'user.email' => 'bail|required|string|max:25|email|unique:users,email',
            'password' => 'bail|required|string|min:8',
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

        DB::transaction(function() {
            $this->user->password = $this->password;
            $this->user->save();
            $this->user->roles()->sync($this->role_ids);
            $this->user->load('roles');

            app()->make(OperationLogService::class)->create($this->user, 0);
        });

        return redirect()->to(route('users'))->with('success', __('A new record has been added.'));
    }

    public function render()
    {
        return view($this->view)->layoutData($this->only([
            'menu_data',
        ]));
    }
}
