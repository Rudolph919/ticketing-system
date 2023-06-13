<?php

namespace App\Models;

use App\Models\TicketStatus;
use App\Models\TicketCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ticket_number',
        'name',
        'surname',
        'email',
        'phone_number',
        'ip_address',
        'ticket_subject',
        'category_id',
        'status_id',
        'ticket_description',
        'latitude',
        'longitude',
    ];

    public function ticketCategory()
    {
        return $this->belongsTo(TicketCategory::class, 'category_id', 'id');
    }

    public function ticketStatus()
    {
        return $this->belongsTo(TicketStatus::class, 'status_id', 'id');
    }
}
