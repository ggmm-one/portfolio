<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail; //from laravel default auth user

    public const DD_NAME_LENGTH = 256;
    public const DD_EMAIL_LENGTH = 256;

    protected $fillable = [
        'name', 'email', 'password', 'role_pid'
    ];

    protected $hidden = [
        'id', 'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = ['role'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function getRolePidAttribute()
    {
        return $this->role->pid ?? null;
    }

    public function setRolePidAttribute($value)
    {
        $this->attributes['role_id'] = Role::getId($value);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('name');
    }
}
