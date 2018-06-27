<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Observers\AdjustmentItemObserver;

class AdjustmentItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'adjustment',
        'diff',
    ];

    public function getUomAttribute()
    {
        return $this->product->uom->abbreviation;
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

        AdjustmentItem::observe(new AdjustmentItemObserver);
    }
}
