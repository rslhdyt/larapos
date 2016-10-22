<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdjustmentItem extends Model
{
    /**
     * setup variable mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'adjustment',
        'diff',
    ];

    public function trackings()
    {
        return $this->morphOne('App\InventoryTracking', 'trackable');
    }
}
