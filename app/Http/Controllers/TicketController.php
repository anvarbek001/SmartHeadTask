<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Ticket;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'custom_id' => 'required',
                'topic' => 'required',
                'text' => 'required'
            ]);

            if ($validate->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => "Data entry error"
                ], 422);
            }

            $customer = Customer::where('id', $request->custom_id)->first();

            if (!$customer) {
                return response()->json([
                    'success' => false,
                    'message' => "Customer not found"
                ], 400);
            }

            $customTicket = $customer->tickets()->latest()->first();

            if ($customTicket && $customTicket->created_at->toDateString() === now()->toDateString()) {
                return response()->json([
                    'success' => false,
                    'message' => "You have a ticket for today."
                ], 400);
            }

            $ticket = Ticket::create([
                'customer_id' => $customer->id,
                'topic' => $request->topic,
                'text' => $request->text,
                'status' => 'new',
            ]);

            $pdf = Pdf::loadView('tickets.pdf', ['ticket' => $ticket]);

            $pdfContent = $pdf->output();
            $fileName = "ticket-{$ticket->id}.pdf";

            $ticket->addMediaFromString($pdfContent)->usingFileName($fileName)->usingName("Ticket #{$ticket->id}")->toMediaCollection('ticket_pdf');


            return response()->json([
                'success' => true,
                'message' => "Ticket created"
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
                'line'    => $th->getLine(),
                'file'    => $th->getFile(),
            ], 500);
        }
    }

    public function widget($customer_id)
    {

        if (!$customer_id) {
            return redirect()->route('/');
        }

        $tickets = Ticket::where('customer_id', $customer_id)->with('media')->get();
        return view('widget.index', [
            'tickets' => $tickets,
            'custom_id' => $customer_id
        ]);
    }

    public function statistics($user_id)
    {
        $user = User::where('id', $user_id)->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => "Forbidden"
            ], 403);
        }


        $daily = Ticket::whereDate('created_at', Carbon::today())->count();

        $weekly = Ticket::whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])->count();

        $monthly = Ticket::whereMonth('created_at', Carbon::now()->month)->count();

        return response()->json([
            'success' => true,
            'message' => "Ok",
            'daily_tickets' => $daily,
            'weekly_tickets' => $weekly,
            'monthly_tickets' => $monthly
        ], 200);
    }

    public function updateStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $ticket->update(['status' => $request->status]);

        return response()->json(['success' => true]);
    }
}
