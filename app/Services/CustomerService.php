<?php

namespace App\Services;

use App\Models\User;
use App\Models\Customer;

class CustomerService
{   
    public function createCustomer(User $user): Customer
    {
        Return Customer::create([
            'user_id' => $user->id,
        ]);
    }  
}