<?php

namespace App\Services;

use App\Repositories\TicketRepository;
use App\Repositories\UserRepository;
use Elastic\Elasticsearch\ClientBuilder;
use Faker\Factory as Faker;
use Log;

class TicketIndexService
{
    private $ticketRepository;
    private $elasticsearchClient;

    public function __construct()
    {
        $this->elasticsearchClient = ClientBuilder::create()->build();
        $this->ticketRepository = new TicketRepository();
    }


    public function getTicketsArray($tickets)
    {
        $ticketsArray = [];
        foreach ($tickets as $key => $value) {
            $ticketsArray[] = $value;
        }

        return $ticketsArray;
    }

    public function getDenormalizedTicketData($ticketIds = []){
        $tickets = $this->ticketRepository->getAllTickets($ticketIds);

        $tickets = $this->getTicketsArray($tickets);

        return $tickets;
    }

    public function indexTickets($ticketIds = [])
    {
        
        $tickets = $this->getDenormalizedTicketData($ticketIds);

        foreach($tickets as $ticket) {
            $id = $ticket['id'];
            unset($ticket['id']);
            Log::info($id,[$ticket]);
            $params = [ 
                'index' => 'ticket_index1',
                'id'    => $id,
                'body'  => $ticket
            ];
            $response = $this->elasticsearchClient->index($params);
        }
        return response()->json($response);
    }
}