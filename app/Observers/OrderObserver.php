<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\OrderProduct;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class OrderObserver
{
    public function deleted(Order $order)
    {
        OrderProduct::where('order_id',$order->id)->delete();
    }
}