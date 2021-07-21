<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ssn extends Model
{
    protected $fillable = ['first_name', 'middle_name', 'last_name', 'dob', 'gender', 'ssn',
    'address', 'state_id', 'city', 'zip', 'phone', 'email'];

    public function state()
    {
        return $this->belongsTo('App\Models\State');
    }
}
