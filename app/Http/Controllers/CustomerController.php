<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
            'phone' => ['required', 'regex:/^(\+998|998)[0-9]{9}$/'],
            'email' => 'required|email'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => "Data entry error"
            ], 422);
        }

        $custom = Customer::where('email', $request->email)->first();

        if ($custom) {
            return response()->json([
                'success' => true,
                'message' => "Customer login",
                'id' => $custom->id,
            ], 200);
        }

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone
        ]);

        if (!$customer) {
            return response()->json([
                'success' => false,
                'message' => "Bad Request"
            ], 400);
        } else {
            return response()->json([
                'success' => true,
                'message' => "Customer created",
                'id' => $customer->id,
            ], 201);
        }
    }
}
