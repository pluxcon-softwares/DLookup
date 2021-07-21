<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketReply extends Model
{
    protected $fillable = ['user_id', 'ticket_id', 'reply'];

    public function user()
    {
        $this->belongsTo('App\Models\User');
    }

    public function ticket()
    {
        $this->belongsTo('App\Models\Ticket');
    }
}
