<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'hl_ticket';

    // protected $dispatchesEvents = [
    //     'created' => TicketCreated::class,
    //     'saved' => TicketUpdated::class,
    // ];
}
