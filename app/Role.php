<?php

namespace App;

use App\Model;

class Role extends Model
{
    public const DD_NAME_LENGTH = 256;

    public const PERMISSION_NONE = 'N';
    public const PERMISSION_READ = 'R';
    public const PERMISSION_ALL = 'A';
    public const PERMISSIONS = [
        self::PERMISSION_NONE => 'None',
        self::PERMISSION_READ => 'Read',
        self::PERMISSION_ALL => 'All'
    ];

    public const CHECK_BEFORE_DELETING = [
        [User::class, 'role_id', 'Cannot delete role. Please re-assign users and try again.'],
    ];

    protected $fillable = [
        'name', 'permission_portfolios', 'permission_projects', 'permission_resources', 'permission_resources', 'permission_admin'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('name');
    }

    public static function getSelectList()
    {
        return Role::select('id', 'pid', 'name')->ordered()->get()->pluck('name', 'pid');
    }

    public function adminNone()
    {
        return $this->permission_admin == static::PERMISSION_NONE;
    }

    public function adminRead()
    {
        return $this->permission_admin == static::PERMISSION_READ;
    }

    public function adminAll()
    {
        return $this->permission_admin == static::PERMISSION_ALL;
    }

    public function resourcesNone()
    {
        return $this->permission_resources == static::PERMISSION_NONE;
    }

    public function resourcesRead()
    {
        return $this->permission_resources == static::PERMISSION_READ;
    }

    public function resourcesAll()
    {
        return $this->permission_resources == static::PERMISSION_ALL;
    }
}
