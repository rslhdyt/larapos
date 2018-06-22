<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'company_name',
        'email',
        'phone',
        'address',
    ];

    /**
     * The model rules.
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'email' => 'required|unique:suppliers,email',
        'phone' => 'required',
        'address' => 'required',
    ];
}
