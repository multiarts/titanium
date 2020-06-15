<?php

namespace App\Models;

use App\User;
use App\Presenters\ChamadosPresenter;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Chamados extends Model
{
    use PresentableTrait;

    protected $presenter = ChamadosPresenter::class;

    protected $fillable = [
        'id', 'number', 'client_id', 'sub_client_id', 'agency', 'sigla', 'dt_scheduling', 'arrival_time', 'type', 'v_deslocamento', 'v_titanium', 'user_id', 'tecnico_id', 'v_atendimento', 'v_km', 'zipcode', 'address', 'state_id', 'cite_id', 'occurrence', 'solution', 'responsavel', 'tel_responsavel', 'produtiva', 'serial', 'model', 'marca', 'status', 'documentacao', 'departure_time', 'rat', 'note'
    ];
    /*
    protected $casts = [
        'valor' => 'decimal:2',
    ];*/
    protected $dates = [
        'dt_scheduling',
    ];

    protected $dateFormat = 'Y-m-d';
    
    public function tecnico()
    {
        return $this->belongsTo(Tecnico::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function analista()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'cite_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function subClient()
    {
        return $this->belongsTo(SubClient::class, 'sub_client_id');
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('number', $value)->firstOrFail();
    }
}
