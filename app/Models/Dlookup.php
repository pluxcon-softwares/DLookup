<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dlookup extends Model
{
    protected $fillable = ['first_name', 'middle_name', 'last_name', 'class', 'issue_date', 'expire_date',
    'dl_number', 'address', 'city', 'state_id', 'zipcode', 'restrictions', 'height', 'gender',
    'dob', 'restrictions', 'height'];

    public function state()
    {
        return $this->belongsTo('App\Models\State');
    }
}
