<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'active', 'wallet'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket');
    }

    public function ticketReplies()
    {
        return $this->hasMany('App\Models\TicketReply');
    }

    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }

    public function ssnOrders()
    {
        return $this->hasMany('App\Models\SsnOrder');
    }

    public function dlOrders()
    {
        return $this->hasMany('App\Models\DlOrder');
    }
}
