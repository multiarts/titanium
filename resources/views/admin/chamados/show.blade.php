@extends('adminlte::page')

@section('title', 'Chamados')

@section('content_header')
<div class="row mb-2">
  <div class="col-sm-6">
    <h1 class="m-0 text-dark">Chamados</h1>
  </div><!-- /.col -->
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="{{ route('dashboard.') }}" title="Painel"><i class="fad fa-home"></i></a>
      </li>
      <li class="breadcrumb-item"><a href="{{ route('dashboard.chamados.index') }}">Chamados</a></li>
      <li class="breadcrumb-item active">{{ $chamado->number }}</li>
    </ol>
  </div><!-- /.col -->
</div>
@stop

@section('content')
<div class="row">
  <div class="col-12">
    <div class="container-fluid">
      <div class="card card-outline card-navy fadeIn">
        <div class="card-header">
          <table class="table table-sm " role="grid">
            <tbody class="text-navy">
              <tr>
                <th>{{ $chamado->present()->tipo }} nº: <span class="text-dark">{{ $chamado->number }}</span></th>
                <th>Técnico: <span class="text-dark">{{ $chamado->tecnico->name }}</span></th>
                <th>Analista: <span class="text-dark">{{ $chamado->analista->name }}</span></th>
                <th>Status: <span class="text-dark">{!! $chamado->present()->statusFormated !!}</span></th>
                <th>
                  <a href="#" onclick="window.print();return false;" class="btn btn-sm btn-info btn-flat d-print-none">
                    <i class="fad fa-print"></i> Imprimir
                  </a>
                </th>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-4"><strong>Agendado para:</strong> {!! $chamado->present()->date_br !!}</div>
            <div class="col-md-4"><strong>Horário agendado:</strong> {{ $chamado->departure_time }}</div>
            <div class="col-md-4 "><strong>Valor atendimento:</strong> R${{ $chamado->v_atendimento }}</div>
          </div>
          <div class="row">
            <div class="col-md-4"><strong>{{ __('Cliente') }}:</strong> {{ $chamado->subClient->name }}</div>
            <div class="col-md-4"><strong>Endereço:</strong> {{ $chamado->address }}</div>
            <div class="col-md-4"><strong>CEP:</strong> {{ $chamado->zipcode }}</div>
          </div>
          <div class="row">
            <div class="col-md-4"><strong>Estado:</strong> {!! $chamado->state->title !!}</div>
            <div class="col-md-4"><strong>Cidade:</strong> {{ $chamado->city->title }}</div>
            <div class="col-md-4"><strong></strong></div>
          </div>
          <div class="row">
            <div class="col-md-4"><strong>Responsável no local:</strong> {{ $chamado->responsavel }}</div>
            <div class="col-md-6"><strong>Telefone:</strong> {{ $chamado->tel_responsavel }}</div>
          </div>
          <div class="row">
            <div class="col-md-4"><strong>Ocorrência:</strong><br> {{ $chamado->occurence }}</div>
            <div class="col-md-6"><strong>Solução:</strong><br> {{ $chamado->solution }}</div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <strong>Acompanhamento:</strong> {!! $chamado->observacao !!}
            </div>
          </div>
        </div>
        <div class="card-footer">
          <a href="#" onclick="window.print();return false;" class="btn btn-flat btn-info btn-sm d-print-none">
            <i class="fad fa-print"></i> Imprimir
          </a>
          <a href="{{ route('dashboard.chamados.edit', $chamado->number) }}" title="Editar"
            class="btn btn-flat btn-success btn-sm d-print-none">
            <i class="fas fa-edit"></i> Editar
          </a>
          <a href="javascript:window.history.back()" class="btn btn-flat btn-warning btn-sm d-print-none">
            <i class="fas fa-chevron-left"></i> Voltar
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('js')
<script>
  $('.preloader').hide()
</script>
@stop