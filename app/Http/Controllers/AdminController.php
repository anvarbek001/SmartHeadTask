<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::with('customer', 'media');

        if ($request->name) {
            $query->whereHas('customer', function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->name . '%');
            });
        }
        if ($request->email) {
            $query->whereHas('customer', function ($q) use ($request) {
                $q->where('email', $request->email);
            });
        }

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [
                $request->start_date,
                $request->end_date
            ]);
        } elseif ($request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        } elseif ($request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        } elseif ($request->status) {
            $query->where('status', $request->status);
        }
        $tickets = $query->simplePaginate(10);
        return view('admin.index', [
            'tickets' => $tickets
        ]);
    }
}
