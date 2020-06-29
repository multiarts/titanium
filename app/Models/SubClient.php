<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubClient extends Model
{
    protected $fillable = [
        'client_id', 'state_id', 'cite_id', 'name', 'email', 'address', 'phone', 'phone2', 'zipcode', 'bairro', 'cnpj', 'ie', 'site'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    function cite()
    {
        return $this->belongsTo(City::class, 'cite_id');
    }
    
    function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
}
