<?php

namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class ChamadosPresenter extends Presenter
{

    public function valorFormated()
    {
        return 'R$'.number_format($this->v_titanium, 2, ",", ".");
    }

    public function statusFormated()
    {
        $types = [
            0 => '<span class="badge badge-warning">Aberto</span>',
            1 => '<span class="badge badge-success">Concluído</span>',
            2 => '<span class="badge badge-danger">Pendente</span>'
        ];

        return $types[$this->status];
    }

    public function statusSimple()
    {
        $types = [
            0 => 'Aberto',
            1 => 'Concluído',
            2 => 'Pendente'
        ];

        return $types[$this->status];
    }

    public function statusAlert()
    {
        $types = [
            0 => 'warning',
            1 => 'success',
            2 => 'danger'
        ];

        return $types[$this->status];
    }

    public function tipo()
    {
      $types = [
        0 => 'Diária',
        1 => 'Chamado'
      ];

      return $types[$this->type];
    }

    public function date_br()
    {
        return date('d/m/Y', strtotime($this->start));
    }
}
