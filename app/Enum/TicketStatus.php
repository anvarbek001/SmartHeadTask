<?php

namespace App\Enum;

enum TicketStatus: string
{
    case NEW = 'new';
    case INPROCESS = 'inprocess';
    case DONE = 'done';

    public function label()
    {
        return match ($this) {
            self::NEW => 'New',
            self::INPROCESS => 'In processing',
            self::DONE => 'Done',
        };
    }
}
