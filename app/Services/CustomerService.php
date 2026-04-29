<?php

namespace App\Services;

use App\Repositories\CustomerRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerService
{
    public function __construct(protected CustomerRepository $repos) {}

    public function createCustomer($name, $email, $phone)
    {
        $customer = $this->repos->findCustomerByEmail($email);
        if ($customer) {
            return $customer;
        }

        return DB::transaction(function () use ($name, $email, $phone) {
            $customer = $this->repos->customerCreate([
                'name' => $name,
                'email' => $email,
                'phone' => $phone
            ]);

            return $customer;
        });
    }
}
