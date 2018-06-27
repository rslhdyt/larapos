<?php

namespace App\Observers;

use App\Models\ProductStock;
use App\Models\ReceivingItem;

class ReceivingItemObserver
{
    /**
     * Listen to the Receiving item created event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(ReceivingItem $recivingItem)
    {
        $productStock = ProductStock::firstOrNew(['product_id' => $recivingItem->product_id]);
        $productStock->quantity += $recivingItem->quantity;
        $productStock->save();
    }
}
