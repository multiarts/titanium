<?php

namespace App\Models;

use App\Presenters\ChamadosPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Laracasts\Presenter\PresentableTrait;

class Tecnico extends Model
{
  use PresentableTrait;

  protected $presenter = ChamadosPresenter::class;

  protected $fillable = [
    'id', 'name', 'email', 'rg', 'cpf', 'telefone', 'telefone1', 'address', 'state_id', 'cite_id', 'agencia', 'numconta', 'numbanco', 'operacao', 'favorecido', 'tipo', 'active', 'image'
  ];

   /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('active', '=', 'on');
        });
    }

  public function chamados()
  {
    return $this->belongsTo(Chamados::class, 'tecnico_id');
  }

  public function state()
  {
    return $this->belongsTo(State::class, 'state_id');
  }
  public function cities()
  {
    return $this->belongsTo(City::class, 'cite_id');
  }

  public function getTelefoneAttributes($phone)
  {
    $ac = substr($phone, 0, 2);
    $prefix = substr($phone, 2, 5);
    $suffix = substr($phone, 7);

    return "(0{$ac}) {$prefix}-{$suffix}";
  }

  public function getRgAttributea($rg)
  {
    $a = substr($rg, 0, 2); //09
    $b = substr($rg, 2, 2); //41
    $c = substr($rg, 4, 2); //77
    $d = substr($rg, 6, 2); //81
    $e = substr($rg, 8); //34

    return "{$a}{$b}{$c}{$d}{$e}";
  }

  public function setRgAttributea($rg)
  {
    $a = substr($rg, 0, 2); //09
    $b = substr($rg, 2, 2); //41
    $c = substr($rg, 4, 2); //77
    $d = substr($rg, 6, 2); //81
    $e = substr($rg, 8); //34

    $this->attributes['rg'] = "{$a}.{$b}.{$c}.{$d}-{$e}";
  }

  public function getCpfAttributea($cpf)
  {
    $a = substr($cpf, 0, 3); //000
    $b = substr($cpf, 3, 3); //111
    $c = substr($cpf, 6, 3); //222
    $d = substr($cpf, 9, 2); //33

    return "{$a}{$b}{$c}{$d}";
  }

  public function setCpfAttributea($cpf)
  {
    $a = substr($cpf, 0, 3); //000
    $b = substr($cpf, 3, 3); //111
    $c = substr($cpf, 6, 3); //222
    $d = substr($cpf, 9, 2); //33

    $this->attributes['cpf'] = "{$a}.{$b}.{$c}-{$d}";
  }
}
