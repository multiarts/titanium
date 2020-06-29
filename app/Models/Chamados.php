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
        'id', 'number', 'client_id', 'sub_client_id', 'agency_id', 'user_id', 'tecnico_id', 'state_id', 'cite_id', 'prefix', 'sigla', 'start', 'end', 'arrival_time', 'type', 'cot', 'pagamento', 'solicitante', 'tel_solicitante', 'email_solicitante', 'v_deslocamento', 'v_titanium', 'v_atendimento', 'v_km', 'zipcode', 'address', 'occurrence', 'solution', 'responsavel', 'tel_responsavel', 'improdutiva', 'serial', 'model', 'marca', 'status', 'documentacao', 'departure_time', 'rat', 'observacao', 'total'
    ];
    /*
    protected $casts = [
        'valor' => 'decimal:2',
    ];*/
    protected $dates = [
        'start',
        'end'
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
