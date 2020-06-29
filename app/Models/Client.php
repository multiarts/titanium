<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'state_id', 'cite_id', 'name', 'email', 'address', 'phone', 'phone2', 'zipcode', 'bairro', 'cnpj', 'ie', 'site'
    ];

    public function subClient()
    {
        return $this->hasMany(SubClient::class, 'client_id');
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
