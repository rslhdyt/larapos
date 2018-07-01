<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Observers\SalesItemObserver;

class SalesItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'price',
        'quantity',
        'discount',
    ];

    public static function boot()
    {
        parent::boot();

        SalesItem::observe(new SalesItemObserver);
    }
}
