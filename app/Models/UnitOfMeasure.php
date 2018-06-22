<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnitOfMeasure extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'abbreviation',
        'description',
    ];

    /**
     * The model rules.
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'abbreviation' => 'required|unique:unit_of_measures,abbreviation',
    ];
}
