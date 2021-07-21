<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable  = ['user_id', 'title', 'body', 'is_replied'];

    //protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function ticketReplies()
    {
        return $this->hasMany('App\Models\TicketReply');
    }
}
