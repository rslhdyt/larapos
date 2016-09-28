<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * rules validasi untuk data products.
     *
     * @var array
     */
    public static $rules = [
        'name'  => 'required|unique:products',
        'price' => 'required|integer',
    ];

    /**
     * setup variable mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
    ];

    public function scopeSearchByKeyword($query, $keyword)
    {
        if ( $keyword != '' ) {
            $query->where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('barcode', 'LIKE', '%' . $keyword . '%');
            });
        }

        return $query;
    }
}
