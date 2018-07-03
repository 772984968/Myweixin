<?php

namespace App\Policies\Api;

use App\Models\User;
use App\Models\Address;
use Illuminate\Auth\Access\HandlesAuthorization;

class AddressPolicy
{
    use HandlesAuthorization;

     public function view(User $user, Address $address)
    {
        //
    }



    public function update(User $user, Address $address)
    {
        return $user->id === $address->user_id;
    }


    public function delete(User $user, Address $address)
    {
        return $user->id === $address->user_id;

    }

}
