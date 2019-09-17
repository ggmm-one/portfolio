<?php

namespace App;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\PublicAddressable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SessionFlashes;

class User extends Authenticatable
{
    use Notifiable;
    use PublicAddressable;
    use SoftDeletes;
    use SessionFlashes;

    public const DD_NAME_LENGTH = 256;
    public const DD_EMAIL_LENGTH = 256;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'id', 'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

}
