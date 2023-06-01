<?php

namespace App\Models;

use App\Events\TicketCreated;
use App\Events\TicketDeleted;
use App\Events\TicketUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'hl_ticket';

    protected $dispatchesEvents = [
        'created' => TicketCreated::class,
        'saved' => TicketUpdated::class,
        'deleted' => TicketDeleted::class,
    ];
}
