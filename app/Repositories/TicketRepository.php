<?php

namespace App\Repositories;

use App\Models\Ticket;
use App\Models\Customer;
use App\Models\TicketMeta;
use App\Mappers\TicketMapper;

class TicketRepository
{
    private $ticketMapper;
    public function __construct()
    {
        $this->ticketMapper = new TicketMapper();
    }

    public function getAllTickets($ids = [])
    {

        $count = count($ids);

        if ($count == 0) {
            $tickets = Ticket::leftJoin('hl_customers', 'hl_ticket.customer_id', '=', 'hl_customers.id')
                ->get(['hl_ticket.id', 'hl_ticket.ticket_title', 'hl_ticket.ticket_description', 'hl_customers.customer_nicename']);
        } else {
            $tickets = Ticket::leftJoin('hl_customers', 'hl_ticket.customer_id', '=', 'hl_customers.id')
                ->whereIn('hl_ticket.id', $ids)
                ->get(['hl_ticket.id', 'hl_ticket.ticket_title', 'hl_ticket.ticket_description', 'hl_customers.customer_nicename']);
        }

        $ticketIds = [];
        foreach ($tickets as $ticket) {
            $ticketIds[] = $ticket->id;
        }

        $ticketMetaData = TicketMeta::select('ticket_id', 'meta_key', 'meta_value')
            ->whereIn('ticket_id', $ticketIds)
            ->get();


        return $this->ticketMapper->mapTicketsWithMetaData($tickets, $ticketMetaData);
    }

}