<?php

namespace App\Observers;

use App\Models\ProductStock;
use App\Models\AdjustmentItem;

class AdjustmentItemObserver
{
    /**
     * Listen to the Adjustment item created event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(AdjustmentItem $adjustmentItem)
    {
        $productStock = ProductStock::firstOrNew(['product_id' => $adjustmentItem->product_id]);

        // check actual stock with adjustment
        $diff = $adjustmentItem->adjustment - $productStock->quantity;
        $adjustmentItem->diff = $diff;
        $productStock->quantity += $diff;

        $productStock->save();
        $adjustmentItem->save();
    }
}
