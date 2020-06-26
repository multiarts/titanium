<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name', 'address', 'phone', 'states_id', 'cities_id', 'zipcode'
    ];

    public function subClient()
    {
        return $this->hasMany(SubClient::class, 'client_id');
    }

    function citie()
    {
        return $this->belongsTo(City::class, 'cities_id');
    }
    
    function state()
    {
        return $this->belongsTo(State::class, 'states_id');
    }
}
