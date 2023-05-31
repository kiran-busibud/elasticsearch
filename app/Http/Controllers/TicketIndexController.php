<?php

namespace App\Http\Controllers;

use App\Services\TicketIndexService;
use Illuminate\Http\Request;

class TicketIndexController extends Controller
{
    private $ticketIndexService;
    public function __construct(){
        $this->ticketIndexService = new TicketIndexService();
    }

    public function getAllTickets()
    {
        $tickets = $this->ticketIndexService->getDenormalizedTicketData();
        dd($tickets);
        // return response()->json($tickets);
    }

    public function indexAllTickets()
    {
        $response = $this->ticketIndexService->indexTickets();
        return response()->json($response);
    }
}
