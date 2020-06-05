<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>{{ $tecnico->name }}</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <style>
    .text-primary {
      color: #0f79b6
    }
  </style>
</head>

<body>
  <div class="row">
    <div class="col-12">
      <table id="table" class="table" width="100%">
        <thead class="text-primary">
          <tr>
            {{-- <th>#</th> --}}
            <th>Nº chamado</th>
            <th>Analista</th>
            <th>Dt. agendamento</th>
            <th>Valor</th>
            <th>Status</th>
            <th class="text-right">Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($chamados as $tec)
          <tr>
            <td>
              {!! $tec->number !!}
            </td>
            <td>
              {{ $tec->analista->name }}
            </td>
            <td>
              {{ $tec->present()->date_br }}
            </td>
            <td>
              {{ $tec->present()->valorFormated }}
            </td>
            <td>
              {!! $tec->present()->statusFormated !!}
            </td>
            <td>
              <a href="{{ url('dashboard/tecnicos/pdf', $tec->id)}}" target="_blank" class="btn text-info"
                title="Imprimir"><i class="fas fa-print"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>