<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name_role',
        'description',
        'icon',
        'url',
        'is_active',
    ];

    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }
}
