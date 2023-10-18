<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Order;
class OrderPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
      function update(User $user,Order $order): Response
       {
        if($user->role==='admin' or $order->user_id === $user->id){
            return  true;
        }
        return false;
    }
         
}
