<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    private $subordinates;

    protected $table = 'roles';

    protected $fillable = [
        'title', 'code', 'rank', 'status', 'permissions',
    ];

    protected $attributes = [
        'permissions' => '[]',
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

    /* Me: Return this role's enabled subordinates + passed roles. */
    public function assignables($roles = null)
    {
        if (isset($roles)) {
            $f = function ($sr) use ($roles) {
                return $sr->status === 1 || $roles->contains($sr);
            };
        } else {
            $f = function ($sr) {
                return $sr->status === 1;
            };
        }

        return $this->subordinates()->filter($f);
    }
}
