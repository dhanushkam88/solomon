<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketInformation extends Model
{
    use HasFactory;

    protected $table = 'ticket_information';

    protected $fillable = [
        'ticket_id',
        'details',
        'message_status',
        'sender',
    ];
}
