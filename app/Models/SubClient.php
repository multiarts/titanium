<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubClient extends Model
{
    protected $fillable = [
        'name', 'address', 'phone', 'client_id', 'state_id', 'citie_id'
    ];

    public function client()
    {
        return $this->hasMany(Client::class, 'client_id');
    }
}
