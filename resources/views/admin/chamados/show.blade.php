<div class="modal-header card-header card-header-info">

  <div class="modal-title">
    <div class="row">
      <div class="col-md-4"><strong>{{ $chamado->present()->tipo }} nº:</strong> {{  $chamado->number }}</div>
      <div class="col-md-4"><strong>Analista:</strong> {{ $chamado->analista->name }}</div>
      <div class="col-md-4 text-right"><strong>Status:</strong> {!! $chamado->present()->statusFormated !!}</div>
    </div>
  </div>
</div>
<div class="modal-body">
  <div class="popupMessageContainer container-fluid">
    <div class="row">
      <div class="col-md-4"><strong>Agendado para:</strong> {!! $chamado->present()->date_br !!}</div>
      <div class="col-md-4"><strong>Horário agendada:</strong> {{ $chamado->departure_time }}</div>
      <div class="col-md-4 "></div>
    </div>
    <div class="row">
      <div class="col-md-4"><strong>Cliente:</strong> {{ $chamado->subClient->name }}</div>
      <div class="col-md-4"><strong>Endereço:</strong> {{ $chamado->address }}</div>
      <div class="col-md-4"><strong>CEP:</strong> {{ $chamado->cep }}</div>
    </div>
    <div class="row">
      <div class="col-md-4"><strong>Estado:</strong> {!! $chamado->state->title !!}</div>
      <div class="col-md-4"><strong>Cidade:</strong> {{ $chamado->city->title }}</div>
      <div class="col-md-4"><strong></strong></div>
    </div>
    <p></p>
  </div>
  <div class="modal-footer">
    <a href="{{ route('dashboard.chamados.edit', $chamado->number) }}" title="Editar"
       class="btn btn-success btn-sm">
      <i class="fas fa-edit"></i> Editar
    </a>
    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
      <i class="fas fa-cancel"></i> Fechar
    </button>
  </div>
</div>
