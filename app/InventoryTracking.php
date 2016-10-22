<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryTracking extends Model
{
    /**
     * setup variable mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'product_id',
    ];

    /**
     * Get all of the owning commentable models.
     */
    public function trackable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
