<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function subClient()
    {
        return $this->hasMany(SubClient::class, 'client_id');
    }
}
