<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePriveleges extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'role',
        'namespace'
    ];

    public function getRole()
    {
        return $this->hasMany(Roles::class, 'id');
    }

    public function getPrivilege()
    {
        return $this->hasMany(Priveleges::class, 'id');
    }

    public function sluggable(): array
    {
        return [];
    }
}
