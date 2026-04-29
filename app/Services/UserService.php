<?php

namespace App\Services;

use App\Repositories\TicketRepository;
use App\Repositories\UserRepository;

class UserService
{
    public function __construct(protected UserRepository $repository, protected TicketRepository $ticketRepo) {}

    public function statistics($userId)
    {
        $user = $this->repository->findUserById($userId);
        if (!$user) {
            throw new \Exception("Unauthorized", 401);
        }

        return $this->ticketRepo->statisticsTickets();
    }
}
