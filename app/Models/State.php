<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = ['code', 'state'];


    public function ssn()
    {
        return $this->hasMany('App\Models\Ssn');
    }

    public function dl()
    {
        return $this->hasMany('App\Models\Dlookup');
    }
}
