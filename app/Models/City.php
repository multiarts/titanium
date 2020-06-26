<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function Chamados()
    {
        return $this->belongsTo(Chamados::class, 'cite_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
}
