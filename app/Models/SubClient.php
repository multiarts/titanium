<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubClient extends Model
{
    public function client()
    {
        return $this->hasMany(Client::class, 'client_id');
    }
}
