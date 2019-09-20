<?php

namespace App;

use App\Model;
use App\Scopes\OrderScope;

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

    protected $fillable = [
        'name', 'permission_portfolios', 'permission_projects', 'permission_resources', 'permission_resources', 'permission_admin'
    ];

    protected $checkBeforeDeleting = [
        [User::class, 'role_id', 'Cannot delete role. Please re-assign users and try again.'],
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public static function getSelectList()
    {
        return Role::select('id', 'pid', 'name')->get()->pluck('name', 'pid');
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new OrderScope('name', 'ASC'));
    }
}
