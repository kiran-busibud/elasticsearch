<?php

namespace App\Listeners;

use App\Events\TicketDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IndexDeletedTicket
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TicketDeleted $event): void
    {
        //
    }
}
