<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DlOrder extends Model
{
    protected $fillable = ['user_id', 'dl_id', 'first_name', 'middle_name', 'last_name', 'dob', 'class',
    'issue_date', 'expire_date', 'dl_number', 'address', 'city', 'state', 'zip', 'restrictions',
    'height', 'gender'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
