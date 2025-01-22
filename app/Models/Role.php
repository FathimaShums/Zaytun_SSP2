<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // The attributes that are mass assignable
    protected $fillable = ['name'];

    /**
     * Define the relationship between Role and User.
     * A role can have many users.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'RoleID');
    }
}