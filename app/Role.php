<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * rules validasi untuk data suppliers.
     *
     * @var array
     */
    public static $rules = [
        'name'        => 'required|unique:roles',
        'description' => 'required|max:140',
    ];

    /**
     * setup variable mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Permission')->withTimestamps();
    }

    public static function dropdown()
    {
        return [null => '--Choose Role--'] + Self::all()->pluck('name', 'id')->toArray();
    }
}
