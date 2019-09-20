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

    protected $fillable = [
        'name', 'permission_portfolios', 'permission_projects', 'permission_resources', 'permission_resources', 'permission_admin'
    ];
}
