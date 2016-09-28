<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public static $rules = [
        'customer_id' => 'required',
        'cashier_id'  => 'required',
    ];

    /**
     * setup variable mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'cashier_id',
    ];

    public function items()
    {
        return $this->hasMany('App\SaleItem');
    }
}
