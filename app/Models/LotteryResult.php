<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LotteryResult extends Model
{
    protected $fillable = [
        'week', 'week_date', 'w1', 'w2', 'w3', 'w4', 'w5', 'm1', 'm2', 'm3', 'm4', 'm5'
    ];
}
