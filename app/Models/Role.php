<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
	use SoftDeletes;

    private $subordinates;

    protected $table = 'roles';

    protected $fillable = [
        'title', 'code', 'rank', 'status', 'permissions',
    ];

    protected $casts = [
        'permissions' => 'array',
    ];

    /* Me: Defining relationships. */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /* Me: Return this role's subordinates. */
    public function subordinates()
    {
        if (is_null($this->subordinates)) {
            $this->subordinates = self::where('rank', '>=', $this->rank)->orderBy('title', 'ASC')->get();
        }

        return $this->subordinates;
    }

    /* Me: Return this role's enabled subordinates + passed role. */
    public function assignables(Role $role = null)
    {
        if (isset($role)) {
            $f = function ($sr) use ($role) {
                return $sr->status === 1 || $sr->id === $role->id;
            };
        } else {
            $f = function ($sr) {
                return $sr->status === 1;
            };
        }

        return $this->subordinates()->filter($f);
    }
}
