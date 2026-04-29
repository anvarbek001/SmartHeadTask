<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\Ticket;
use Carbon\Carbon;

class TicketRepository
{
    public function findCustomerById($id)
    {
        return Customer::find($id);
    }

    public function findTicketByCustomerIdWithMedia($customerId)
    {
        return Ticket::where('customer_id', $customerId)->orderBy('id', 'DESC')->with('media')->get();
    }

    public function getCustomerTicketForToday($customerId)
    {
        return Ticket::where('customer_id', $customerId)
            ->whereDate('created_at', now()->toDateString())
            ->first();
    }

    public function create(array $data)
    {
        return Ticket::create($data);
    }
    
    public function statisticsTickets()
    {
        $daily = Ticket::whereDate('created_at', Carbon::today())->count();

        $weekly = Ticket::whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])->count();

        $monthly = Ticket::whereMonth('created_at', Carbon::now()->month)->count();

        return [
            'daily' => $daily,
            'weekly' => $weekly,
            'monthly' => $monthly
        ];
    }
}
