<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class CustomerController extends Controller
{
    public function store(CustomerRequest $request, CustomerService $service)
    {

        $customer = $service->createCustomer($request->name, $request->email, $request->phone);

        if ($customer) {
            return response()->json([
                'success' => true,
                'message' => "Customer created",
                'id' => $customer->id,
            ], 201);
        }
    }
}
