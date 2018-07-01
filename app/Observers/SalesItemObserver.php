<?php

namespace App\Observers;

use App\Models\ProductStock;
use App\Models\SalesItem;

class SalesItemObserver
{
    /**
     * Listen to the Receiving item created event.
     *
     * @param  \App\Models\SalesItem  $salesItem
     * @return void
     */
    public function created(SalesItem $salesItem)
    {
        $productStock = ProductStock::firstOrNew(['product_id' => $salesItem->product_id]);
        $productStock->quantity -= $salesItem->quantity;
        $productStock->save();
    }
}
