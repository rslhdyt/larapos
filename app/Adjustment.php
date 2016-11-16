<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Adjustment extends Model
{
    public static $rules = [
        'user_id' => 'required',
        'items'   => 'required',
    ];

    /**
     * setup variable mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function items()
    {
        return $this->hasMany('App\AdjustmentItem');
    }

    public function getTotalItemAttribute()
    {
        return $this->items->count();
    }

    public static function createAll($input_form)
    {
        return DB::transaction(function () use ($input_form) {
            // create object item
            $items = collect($input_form['items'])->map(function ($item) {
                return new AdjustmentItem($item);
            });

            $adjustments = self::create($input_form);
            $adjustments->items()->saveMany($items);

            $trackings = $adjustments->items->each(function ($item) use ($input_form) {
                $tracking = new InventoryTracking([
                    'user_id'    => $input_form['user_id'],
                    'product_id' => $item['product_id'],
                ]);

                // update qty
                $product = Product::find($item['product_id']);
                $product->quantity = $product->quantity + $item['diff'];
                $product->save();

                $item->trackings()->save($tracking);
            });
        });
    }
}
