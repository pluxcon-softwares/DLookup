<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SsnOrder extends Model
{
    protected $fillable = ['user_id', 'order_id', 'first_name', 'middle_name', 'last_name', 'dob', 'gender',
                'ssn', 'address', 'state', 'city', 'zip', 'phone', 'email'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
