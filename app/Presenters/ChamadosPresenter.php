<?php

namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class ChamadosPresenter extends Presenter
{

    public function v_titanium()
    {
        return 'R$'.number_format($this->v_titanium, 2, ",", ".");
    }

    public function v_deslocamento()
    {
        return 'R$'.number_format($this->v_deslocamento, 2, ",", ".");
    }

    public function v_atendimento()
    {
        return 'R$'.number_format($this->v_atendimento, 2, ",", ".");
    }
    
    public function v_km()
    {
        return 'R$'.number_format($this->v_km, 2, ",", ".");
    }

    public function statusFormated()
    {
        $types = [
            0 => '<span class="badge badge-warning">Aberto</span>',
            1 => '<span class="badge badge-secondary">Em andamento</span>',
            2 => '<span class="badge badge-danger">Fechado</span>',
            3 => '<span class="badge badge-success">Finalizado</span>'
        ];

        return $types[$this->status];
    }

    public function statusSimple()
    {
        $types = [
            0 => 'Aberto',
            1 => 'Em andamento',
            2 => 'Fechado',
            3 => 'Finalizado',
        ];

        return $types[$this->status];
    }

    public function statusAlert()
    {
        $types = [
            0 => 'warning',
            1 => 'secodary',
            2 => 'danger',
            3 => 'success',
        ];

        return $types[$this->status];
    }

    public function tipo()
    {
      $types = [
        0 => 'Diária',
        1 => 'Chamado',
        2 => 'Cotação',
      ];

      return $types[$this->type];
    }

    public function date_br()
    {
        return date('d/m/Y', strtotime($this->start));
    }
}
