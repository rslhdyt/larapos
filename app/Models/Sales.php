<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    // soon stored in database
    public static $paymentMethods = [
        ['id' => 1, 'name' => 'Cash'],
        ['id' => 2, 'name' => 'Debit'],
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'cashier_id',
        'comments',
    ];

    /**
     * The model rules.
     *
     * @var array
     */
    public static $rules = [
        'cashier_id' => 'required',
        'items' => 'required|min:1',
        'payments' => 'required|min:1'
    ];

    public function cashier()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class)->withDefault([
            'name' => 'Walk in customer',
        ]);
    }

    public function items()
    {
        return $this->hasMany(SalesItem::class);
    }

    public function payments()
    {
        return $this->hasMany(SalesPayment::class);
    }
}
