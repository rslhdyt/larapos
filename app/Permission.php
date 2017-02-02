<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * rules validasi untuk data suppliers.
     *
     * @var array
     */
    public static $rules = [
        'object' => 'required',
        'action' => 'required',
    ];

    /**
     * setup variable mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'object',
        'action',
    ];

    /**
     * relation to roles table.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role')->withTimestamps();
    }

    public function getNameAttribute()
    {
        return $this->attributes['action'] . '-' . $this->attributes['object'];
    }

    public function setObjectAttribute($object)
    {
        $this->attributes['object'] = strtolower($object);
    }

    public function setActionAttribute($action)
    {
        $this->attributes['action'] = strtolower($action);
    }

    public static function grouped()
    {
        $permissions = self::all();

        $grouped_permission = [];

        foreach ($permissions as $key => $permission) {
            $grouped_permission[$permission->object][] = $permission;
        }

        return $grouped_permission;
    }
}
