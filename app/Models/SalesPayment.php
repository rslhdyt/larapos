<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesPayment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'payment_method_id',
        'amount',
    ];

    public function getPaymentMethodAttribute()
    {
        return collect(Sales::$paymentMethods)->filter(function ($paymentMethod) {
            return $paymentMethod->id == $this->payment_method_id;
        });
    }
}
