<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    private $permissions;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'email_verified_at', 'password', 'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* Me: Password mutator */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /* Me: Defining relationships. */
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function highestRole()
    {
        $rank = $this->roles->min('rank');
        return $this->roles->first(function($role) use ($rank) {
            return $role->rank === $rank;
        });
    }

    /* Get user's permissions */
    public function permissions()
    {
        if (is_null($this->permissions)) {
            $this->permissions = $this->roles->pluck('permissions')->collapse()->unique();
        }

        return $this->permissions;
    }

    /* Get menu items from config based on user's permission */
    public function getMenuData($mi_code = null)
    {
        $menu_items = config('cp.menu_items');

        $arr = [];
        foreach ($menu_items as $key => $item) {
            if (isset($item['url']) && $this->can('read_'.$key)) {
                $arr[$key] = [
                    'title' => $item['title'],
                    'url' => $item['url'],
                    'active' => $mi_code === $key,
                ];
            } elseif (isset($item['children'])) {
                $temp_arr = [];
                $active = false;
                foreach ($item['children'] as $code => $child) {
                    if ($this->can('read_'.$code)) {
                        $temp_arr[$code] = [
                            'url' => $child['url'],
                            'title' => $child['title'],
                            'active' => $mi_code === $code,
                        ];
                        if ($mi_code === $code) {
                            $active = true;
                        }
                    }
                }
                if($temp_arr) {
                    $arr[$key] = [
                        'title' => $item['title'],
                        'children' => $temp_arr,
                        'active' => $active,
                    ];
                }
            }
        }
        return $arr;
    }
}
