<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\TicketStatusRequest;
use App\Models\Ticket;
use App\Services\TicketService;
use App\Services\UserService;

class TicketController extends Controller
{
    public function store(StoreTicketRequest $request, TicketService $service)
    {
        try {
            $ticket = $service->createTicketForCustomer(
                $request->custom_id,
                $request->topic,
                $request->text
            );

            return response()->json(['success' => true, 'message' => "Ticket created"], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
                'line'    => $th->getLine(),
                'file'    => $th->getFile(),
            ], 500);
        }
    }

    public function widget($customer_id, TicketService $service)
    {

        if (!$customer_id) {
            return redirect()->route('/');
        }

        $tickets = $service->findTicket($customer_id);
        return view('widget.index', [
            'tickets' => $tickets,
            'custom_id' => $customer_id
        ]);
    }

    public function statistics($user_id, UserService $service)
    {
        $statistics = $service->statistics($user_id);
        return response()->json([
            'success' => true,
            'message' => "Ok",
            'data' => $statistics,
        ], 200);
    }

    public function updateStatus(TicketStatusRequest $request, Ticket $ticket, TicketService $service)
    {
        $service->ticketUpdate($ticket, $request->status);

        return response()->json(['success' => true]);
    }
}
