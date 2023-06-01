<?php

namespace App\Listeners;

use App\Events\TicketCreated;
use App\Services\TicketIndexService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IndexCreatedTicket
{
    /**
     * Create the event listener.
     */

    private $ticketIndexService;
    public function __construct(TicketIndexService $ticketIndexService)
    {
        $this->ticketIndexService = $ticketIndexService;
    }

    /**
     * Handle the event.
     */
    public function handle(TicketCreated $event): void
    {
        $this->ticketIndexService->indexTickets([$event->ticket->id]);
    }
}