<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;


// |--------------------------------------------------------------------------
// | GLOBAL VARIABLES
// |--------------------------------------------------------------------------
// /

// protected $table = 'name';
// protected $primaryKey = 'id';
// public $timestamps = false;
// protected $guarded = [];

protected $fillable = [
    'name',
    'last_name',
    'is_admin',
    'email',
    'password',
];

protected $hidden = [
    'password',
    'remember_token',
];

// protected $dates = [];

// /
// |--------------------------------------------------------------------------
// | FUNCTIONS
// |--------------------------------------------------------------------------
// /

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
// /
// |--------------------------------------------------------------------------
// | RELATIONS
// |--------------------------------------------------------------------------
// /

// /
// |--------------------------------------------------------------------------
// | SCOPES
// |--------------------------------------------------------------------------
// /

// /
// |--------------------------------------------------------------------------
// | ACCESORS
// |--------------------------------------------------------------------------
// /

// /
// |--------------------------------------------------------------------------
// | MUTATORS
// |--------------------------------------------------------------------------

}
