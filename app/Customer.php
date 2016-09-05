<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * rules validasi untuk data customers.
     *
     * @var array
     */
    public static $rules = [
        'name'    => 'required',
        'email'   => 'required|unique:customers',
        'phone'   => 'required',
        'address' => 'required',
    ];

    /**
     * setup variable mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];
}
