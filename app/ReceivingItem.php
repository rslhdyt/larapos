<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceivingItem extends Model
{
    /**
     * setup variable mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'price',
        'quantity',
    ];

    public function getSubtotalAttribute()
    {
        return $this->attributes['price'] * $this->attributes['quantity'];
    }

    public function trackings()
    {
        return $this->morphOne('App\InventoryTracking', 'trackable');
    }
}
