@extends('adminlte::page')

@section('css')
@include('partials.css')
@stop

@section('title', 'Relatórios por cidade')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">{{ $client->name }}</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.chamados.index') }}" title="Chamados"
                    class="text-cyan"><i class="fad fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.report.client') }}">Cliente</a></li>
            <li class="breadcrumb-item active">{{ $client->name }}</li>
        </ol>
    </div><!-- /.col -->
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <table id="table" class="table">
            <thead class="d-print-none">
                <tr>
                    <th>Ordenar</th>
                    <th class="float-right">
                        <a href="#" onclick="window.print();return false;"
								class="btn btn-sm btn-info btn-flat d-print-none">
								<i class="fad fa-print"></i> Imprimir
							</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($chamado as $item)
                @php
                $a = array($item->v_deslocamento, $item->v_km, $item->v_titanium, $item->v_atendimento);
                $subTotal = array_sum($a);
                @endphp
                <tr>
                    <td colspan="2">
                        <div class="card card-outline card-secondary" id="div-{{ $item->number }}">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <b>{{ $item->present()->tipo }}:</b> {{ $item->number }} 
                                    <br><b>Técnico:</b>
                                    {{ $item->tecnico->name }}</h3>
                                <div class="card-tools">
                                    <button class="btn text-navy btn-md btn-flat d-print-none" id="btn-{{ $item->number }}"
                                        id="btn-{{ $item->number }}" onclick='printDiv("div-{{ $item->number }}");'>
                                        <i class="fad fa-print"></i>
                                    </button>

                                    <button type="button" class="btn btn-tool d-print-none" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-lg-4 col-xs-3">
                                        <strong>Agendado para:</strong> {!! $item->present()->date_br !!} <br>
                                        <strong>{{ __('Cliente') }}:</strong> {{ $item->subClient->name }} <br>
                                        <strong>Estado:</strong> {!! $item->state->title !!} <br>
                                        <strong>Responsável no local:</strong> {{ $item->responsavel }} <br>
                                        <strong>Ocorrência:</strong><br> {{ $item->occurence }}
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-xs-3">
                                        <strong>Horário agendado:</strong> {{ $item->departure_time }} <br>
                                        <strong>Endereço:</strong> {{ $item->address }} <br>
                                        <strong>Cidade:</strong> {{ $item->city->title }} <br>
                                        <strong>Telefone:</strong> {{ $item->tel_responsavel }} <br>
                                        <strong>Solução:</strong><br> {{ $item->solution }}
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-xs-3 ">
                                        <strong>Valor atendimento:</strong> R${{ $item->v_atendimento }} <br>
                                        <strong>Valor deslocamento:</strong> R${{ $item->v_deslocamento }} <br>
                                        <strong>Valor Titanium:</strong> R${{ $item->v_titanium }} <br>
                                        <strong>Valor KM:</strong> R${{ $item->v_km }} <br>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-12">
                                      <strong>Acompanhamento:</strong> {!! $item->observacao !!}
                                    </div>
                                  </div>
                            </div>
                            <div class="card-footer">Total: R${{ $subTotal }}</div>
                        </div>
                    </td>
                </tr>


                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('css')
@include('partials.css')
@stop

@section('js')
@include('partials.js')
<script>
    function printDiv(divId) {
        $("#"+divId).kinziPrint();
    }
</script>
@stop