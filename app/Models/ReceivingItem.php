<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Observers\ReceivingItemObserver;

class ReceivingItem extends Model
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
    ];

    public function getsubtotalPriceAttribute()
    {
        return $this->quantity * $this->price;
    }

    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault([
            'name' => '-',
        ]);
    }

    public static function boot()
    {
        parent::boot();

        ReceivingItem::observe(new ReceivingItemObserver);
    }
}
