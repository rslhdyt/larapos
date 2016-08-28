<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    /**
     * rules validasi untuk data products
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|unique:products',
        'price' => 'required|integer'
    ];

    /**
     * setup variable mass assignment
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price'
    ];

}
