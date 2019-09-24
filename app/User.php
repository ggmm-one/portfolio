<?php

namespace App;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as LaravelUser;
use App\Traits\PublicAddressable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SessionFlashes;

class User extends LaravelUser
{
    use Notifiable;
    use PublicAddressable;
    use SoftDeletes;
    use SessionFlashes;

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
