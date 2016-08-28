<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    /**
     * rules validasi untuk data suppliers
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'company_name' => 'required',
        'email' => 'required|unique:suppliers',
        'phone' => 'required',
        'address' => 'required'
    ];

    /**
     * setup variable mass assignment
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'company_name',
        'email',
        'phone',
        'address'
    ];
}
