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

    protected $appends = [
        'total_item',
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

            $sales = self::create($input_form);
            $sales->items()->saveMany($items);
        });
    }
}
