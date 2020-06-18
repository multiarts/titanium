<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function Chamados()
    {
        return $this->belongsTo(Chamados::class, 'cite_id');
    }
}
