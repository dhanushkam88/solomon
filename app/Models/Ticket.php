<?php

namespace App\Models;

use App\Models\TicketInformation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    protected $fillable = [
        'reference_number',
        'name',
        'email',
        'contact_number',
        'description',
        'comments',
        'status',
    ];

    public function ticketInformation()
    {
        return $this->hasMany(TicketInformation::class);
    }

    public function ticketInfoUsingId()
    {
        return $this->hasMany(ticketInformation::class, 'ticket_id');
    }




}
