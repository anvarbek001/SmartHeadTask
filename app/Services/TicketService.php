<?php

namespace App\Services;

use App\Enum\TicketStatus;
use App\Models\Ticket;
use App\Repositories\TicketRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Support\Facades\DB;

class TicketService
{
    public function __construct(protected TicketRepository $repo) {}

    public function createTicketForCustomer($customerId, $topic, $text)
    {
        $customer = $this->repo->findCustomerById($customerId);
        if (!$customer) throw new \Exception("Customer not found", 400);
        if ($this->repo->getCustomerTicketForToday($customerId)) {
            throw new \Exception("You have a ticket for today.", 400);
        }

        return DB::transaction(function () use ($customer, $topic, $text) {
            $ticket = $this->repo->create([
                'customer_id' => $customer->id,
                'topic' => $topic,
                'text' => $text,
                'status' => TicketStatus::NEW->value,
            ]);

            $pdf = Pdf::loadView('tickets.pdf', compact('ticket'));
            $fileName = "ticket-{$ticket->id}.pdf";

            $ticket->addMediaFromString($pdf->output())
                ->usingFileName($fileName)
                ->toMediaCollection('ticket_pdf');

            return $ticket;
        });
    }

    public function ticketUpdate(Ticket $ticket, $status)
    {
        if (!$ticket) {
            throw new Exception('Ticket not found', 400);
        }

        $ticket->update([
            'status' => $status
        ]);
    }

    public function findTicket($customerId)
    {
        return $this->repo->findTicketByCustomerIdWithMedia($customerId);
    }
}
