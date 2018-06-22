<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
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
        'email' => 'required|unique:products,barcode',
    ];
}
