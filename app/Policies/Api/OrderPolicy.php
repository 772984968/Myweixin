<?php

namespace App\Policies\Api;

use App\Models\User;
use App\Models\Order;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;
    public function update(User $user, Order $order)
    {
        return $user->id === $order->user_id;
    }


    public function delete(User $user, Order $order)
    {
        return $user->id === $order->user_id;

    }

}
