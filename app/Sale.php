<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{

    public $invoice_prefix = 'INV';

    public $tax_percentage = 10;

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

    protected $appends = [
        'invoice_no'
    ];

    public function items()
    {
        return $this->hasMany('App\SaleItem');
    }

    public function cashier()
    {
        return $this->belongsTo('App\User', 'cashier_id');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public static function search($params = [])
    {
        return self::when(!empty($params), function ($query) use ($params) {
            switch ($params['date_range']) {
                case 'today':
                    $query->whereDay('created_at', '=', date('d'));
                    break;
                case 'current_week':
                    // $query->where(DB::raw("YEARWEEK(`created_at`, 1) = YEARWEEK(DATE(), 1)"));
                    break;
                case 'current_month':
                    $query->whereMonth('created_at', '=', date('m'));
                    break;
                default:

                    break;
            }

            return $query;
        })->orderBy('created_at', 'DESC');
    }

    public static function createAll($input_form)
    {
        return DB::transaction(function () use ($input_form) {
            // create object item
            $items = collect($input_form['items'])->map(function ($item) {
                return new SaleItem($item);
            });

            $sales = self::create($input_form);
            $sales->items()->saveMany($items);

            $trackings = $sales->items->each(function($item) use ($input_form) {
                $tracking = new InventoryTracking([
                    'user_id'    => $input_form['cashier_id'],
                    'product_id' => $item['product_id'],
                ]);

                // update qty
                $product = Product::find($item['product_id']);
                $product->quantity -= $item['quantity'];
                $product->save();

                $item->trackings()->save($tracking);
            });

            return $sales;
        });
    }

    public function getInvoiceNoAttribute()
    {
        return $this->invoice_prefix . str_pad($this->attributes['id'], 6, 0, STR_PAD_LEFT);
    }

    public function getSubtotalAttribute()
    {
        $subtotal = $this->items->map(function($item){
            return $item->price * $item->quantity;
        });

        return $subtotal->sum();
    }

    public function getTaxAttribute()
    {
        return $this->subtotal * ($this->tax_percentage / 100);
    }
}
