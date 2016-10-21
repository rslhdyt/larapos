<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Receiving extends Model
{
    public static $rules = [
        'supplier_id' => 'required',
        'user_id'  => 'required',
    ];

    /**
     * setup variable mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'supplier_id',
        'user_id',
    ];

    protected $appends = [
        'total_item',
        'total_amount',
    ];

    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }

    public function items()
    {
        return $this->hasMany('App\ReceivingItem');
    }

    public function getTotalItemAttribute()
    {
        return $this->items->count();
    }

    public function getTotalAmountAttribute()
    {
        return $this->items->map(function($item){
            return $item->price * $item->quantity;
        })->sum();
    }

    public static function createAll($input_form)
    {
        return DB::transaction(function () use ($input_form) {
            // create object item
            $items = collect($input_form['items'])->map(function ($item) {
                return new ReceivingItem($item);
            });

            $sales = self::create($input_form);
            $sales->items()->saveMany($items);
        });
    }

}
