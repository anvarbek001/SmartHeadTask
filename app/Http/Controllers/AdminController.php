<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('customer', 'media')->simplePaginate(10);
        return view('admin.index', [
            'tickets' => $tickets
        ]);
    }
}
