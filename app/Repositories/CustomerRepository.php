<?php

namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository
{
    public function findCustomerByEmail($email)
    {
        return Customer::where('email', $email)->first();
    }

    public function customerCreate(array $data)
    {
        return Customer::create($data);
    }
}
