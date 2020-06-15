@extends('adminlte::page')

@section('title', 'Novo chamado/Diária')

@section('css')
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css"> --}}
<style>
  .select2-container--default .select2-results__option[aria-disabled=true] {
    color: #f4f4f4;
    background-color: #fdb2ba;
  }
</style>
@stop

@section('content_header')
<div class="row mb-2">
  <div class="col-sm-6">
    <h1 class="m-0 text-dark">Novo</h1>
  </div><!-- /.col -->
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="{{ route('dashboard.') }}" title="Dashboard"><i class="fad fa-home"></i></a></li>
      <li class="breadcrumb-item"><a href="{{ route('dashboard.chamados.index') }}">Chamados</a></li>
      <li class="breadcrumb-item active">Novo</li>
    </ol>
  </div><!-- /.col -->
</div>
@stop

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex justify-content-between">
              <h4 class="card-title">Cadastro de novo chamado/diária</h4>
              <p class="text-secondary">Chamado aberto por: {{ Auth()->user()->name }}, em <span class="date"></span>
              </p>
            </div>
          </div>
          <div class="card-body">
            <form action="{{ route('dashboard.chamados.store') }}" method="POST" class="form"
              enctype="multipart/form-data">
              @csrf
              <div class="form-row">

                <div class="col-md-2{{ $errors->has('number') ? ' is-invalid' : '' }}">
                  <label for="number">Nº do chamado</label>
                  <input id="number" type="text" placeholder="Número do chamado"
                    class="{{ $errors->has('number') ? ' is-invalid' : '' }} form-control form-control-sm" name="number"
                    value="{{ old('number') }}" required autofocus>
                </div>

                <div class="col-md-3">
                  <label for="client_id">Cliente</label>
                  <select name="client_id" id="client_id" class="form-control form-control-sm">
                    <option value="0" selected disabled>Selecione o cliente</option>
                    @foreach ($clients as $key => $client)
                    <option value="{{ $key }}">{{ $client }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-3">
                  <label for="sub_client_id">SubCliente</label>
                  <select name="sub_client_id" id="sub_client_id" class="form-control form-control-sm" disabled>
                    <option value="0" selected disabled>Selecione o SubCliente</option>
                  </select>
                </div>

                <div class="col-md-2"><label for="agency">Agência</label>
                  <select name="agency" id="agency" class="form-control form-control-sm" disabled>
                    <option value="0" selected disabled>Selecione o agência</option>
										@foreach ($agencies as $key => $ag)
											<option value="{{ $key }}">{{ $ag }}</option>
										@endforeach
                  </select>
                </div>

                <div class="col-md-2">
                  <label for="sigla">Sigla</label>
                  <input type="text" name="sigla" id="sigla" class="form-control form-control-sm" placeholder="Sigla"
                    value="{{ old('sigla') }}">
                </div>
              </div>

              <br>

              <div class="form-row">
                <div class="col-md-2">
                  <div class="form-groups">
                    <label for="dt_scheduling" class="label-control">Data do agendamento</label>
                    <input name="dt_scheduling" id="dt_scheduling" type="date" placeholder="Ex: 15/12/2020"
                      class="datepicker form-control form-control-sm" value="{{ old('dt_scheduling') }}" required>
                  </div>
                </div>

                <div class="col-md-2">
                  <label for="departure_time" class="label-control">H. do agendamento</label>
                  <input name="departure_time" id="departure_time" type="text" placeholder="Hora do agendamento"
                    class="form-control form-control-sm" value="{{ old('departure_time') }}" required>
                </div>

                <div class="col-md-2">
                  <label for="type">Diária/Chamado</label>
                  <select name="type" id="type" class="form-control form-control-sm"
                    data-style="select-with-transitionsss btn-sm btn-outline-primary" tabindex="-98"
                    title="Diária ou chamado">
                    <option value="0">Diária</option>
                    <option value="1">Chamado</option>
                  </select>
                </div>

                @can('gerente')
                <div class="col-md-2">
                  <div class="form-groups">
                    <label for="v_deslocamento" class="label-control">Valor deslocamento</label>
                    <input id="v_deslocamento" name="v_deslocamento" type="text" class="form-control form-control-sm"
                      placeholder="R$30,00" value="{{ old('v_deslocamento') }}">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-groups">
                    <label for="v_titanium" class="label-control">Valor Titanium</label>
                    <input id="v_titanium" name="v_titanium" type="text" class="form-control form-control-sm"
                      placeholder="R$30,00" value="{{ old('v_titanium') }}">
                  </div>
                </div>
                @endcan

              </div>

              <br>

              <div class="form-row">

                <div class="col-md-3">
                  <div class="row">
                    <label for="tecnico_id">Técnico &nbsp; &nbsp;&nbsp;&nbsp;<a href="" id="newTecnico" data-toggle="modal"
                        data-target="#tecnicoModal" class="text-right btn btn-flat btn-outline-info btn-xs">Novo</a>
                    </label>
                  </div>


                  <select name="tecnico_id" id="tecnico_id" class="form-control form-control-sm">
                    {{-- <option value="0" selected disabled>Selecione o Técnico</option> --}}
                    @foreach ($tecnicos as $tec)
                    <option value="{{ $tec->id }}" @if($tec->active == 'off') disabled class="bg-danger" data-icon="fad
                      fa-ban" @endif>{{ $tec->name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-2">
                  <label for="v_atendimento">Valor do atendimento</label>
                  <input id="v_atendimento" type="text" placeholder="R$ 30,00" class="form-control form-control-sm"
                    name="v_atendimento" value="{{ old('v_atendimento') }}" required>
                </div>

                <div class="col-md-2">
                  <label for="v_km">Valor KM</label>
                  <input type="text" name="v_km" id="v_km" class="form-control form-control-sm" placeholder="R$ 40,00"
                    value="{{ old('v_km') }}">
                </div>

                <div class="col-md-4">
                  <label for="user_id" class="label-control">Analista</label>
                  <select name="user_id" id="user_id" class="form-control form-control-sm">
                    <option value="{{ Auth::user()->id }}" selected>
                      {{ Auth::user()->name }}</option>
                    @foreach ($users as $key => $user)
                    <option value="{{ $key }}">{{ $user }}</option>
                    @endforeach
                  </select>
                </div>

              </div>

              <br>

              <div class="form-row">
                <div class="col-md-2">
                  <label for="zipcode">CEP</label>
                  <input id="zipcode" type="text"
                    class="form-control form-control-sm{{ $errors->has('zipcode') ? ' is-invalid' : '' }}"
                    placeholder="CEP" name="zipcode" value="{{ old('zipcode') }}" required>
                </div>

                <div class="col-md-4">
                  <label for="address" class="control-label">Endereço</label><br>
                  <input name="address" id="address" type="text" placeholder="Endereço do banco"
                    class="form-control form-control-sm" value="{{ old('address') }}" required>
                </div>

                <div class="col-md-3">
                  <label for="state_id">Estado</label>
                  <select name="state_id" id="state_id" class="form-control form-control-sm">
                    <option value="0" selected disabled>Selecione o Estado</option>
                    @foreach($states as $key => $state)
                    <option value="{{ $key }}">{{ $state }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-2">
                  <label for="cite_id">Cidade</label>
                  <select name="cite_id" id="cite_id" class="form-control form-control-sm" disabled>
                    <option value="0" selected disabled>Selecione a Cidade</option>
                  </select>
                </div>

              </div>

              <br>

              <div class="form-row">
                <div class="col-md-3">
                  <label for="occurrence">Ocorrência</label>
                  <textarea name="occurrence" id="occurrence" type="text" class="form-control form-control-sm"
                    placeholder="Digite a ocorrência relatada pelo Cliente." rows="3"
                    cols="2">{{ old('occurrence') }}</textarea>
                </div>
                {{-- <div class="col-md-3">
                  <label for="solution">Solução</label>
                  <textarea name="solution" id="solution" type="text" class="form-control form-control-sm"
                    placeholder="Digite a solução dada pelo Técnico no atendimento." rows="3"
                    cols="2">{{ old('solution') }}</textarea>
                </div> --}}
                <div class="col-md-2">
                  <label for="responsavel">Responsável no local</label>
                  <input name="responsavel" id="responsavel" type="text" class="form-control form-control-sm"
                    placeholder="Nome do responsável local." value="{{ old('responsavel') }}">
                </div>
                <div class="col-md-2">
                  <label for="tel_responsavel">Telefone Resp. local</label>
                  <input name="tel_responsavel" id="tel_responsavel" type="tel" class="form-control form-control-sm"
                    placeholder="Tel. do responsável local." value="{{ old('tel_responsavel') }}">
                </div>
              </div>

              <br>

              <div class="form-row">
                {{-- <div class="togglebutton col-md-2">
                  <label>
                    <input type="checkbox" name="produtiva" id="produtiva" value="{{ old('produtiva') }}">
                    <span class="toggle"></span>
                    Produtiva
                  </label>
                </div> --}}

                <div class="col-md-2">
                  <label for="n_serie">Nº de série</label>
                  <input name="serial" id="serial" type="text" class="form-control form-control-sm"
                    placeholder="Número de série" value="{{ old('serial') }}">
                </div>
                <div class="col-md-2">
                  <label for="model">Modelo</label>
                  <input name="model" id="model" type="text" class="form-control form-control-sm"
                    placeholder="Modelo do equipamento">
                </div>
                <div class="col-md-2">
                  <label for="marca">Marca</label>
                  <input name="marca" id="marca" type="text" class="form-control form-control-sm" placeholder="Marca"
                    value="{{ old('marca') }}">
                </div>

                {{-- <div class="form-check">
                  <label>Status da Documentação</label>
                  <br>
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="documentacao" id="documentacao"
                      value="{{ old('documentacao') }}">
                    Documentação
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div> --}}

              </div>

              <br>

              {{-- <div class="form-row">
                <div class="col-md-6">
                  <div class="form-grousp">
                    <label for="rat">Anexar RAT</label>
                    <input type="file" name="rat" id="rat" class="form-controla fileinput-inline">
                  </div>
                </div>
              </div> --}}

              <br>

              <div class="form-row">
                <div class="col-md-12">
                  <label for="observacao">Observações</label>
                  <textarea id="observacao" type="text" placeholder="Observações"
                    class="form-control{{ $errors->has('observacao') ? ' is-invalid' : '' }}"
                    name="observacao">{{ old('observacao') }}</textarea>
                </div>
              </div>

              <br>

              <button type="submit" class="btn btn-sm btn-flat btn-primary">
                <i class="fad fa-save"></i> Cadastrar
              </button>

              <a href="{{ route('dashboard.chamados.index') }}" class="btn btn-sm btn-flat btn-danger">
                <i class="fad fa-times"></i> Cancelar
              </a>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal create new técnico-->
<div class="modal" id="tecnicoModal" tabindex="-1" role="dialog" aria-labelledby="tecnicoModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tecnicoModalLabel">Novo Técnico</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formModal">
          <div class="form-group">
            <label for="name">Nome do Técnico:</label>
            <input type="text" name="name" class="form-control" placeholder="Nome do técnico" required>
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" placeholder="Email" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-flat btn-sm btn-secondary col-sm-4" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-flat btn-sm btn-success btn-submit col-sm-4">Salvar</button>
      </div>
    </div>
  </div>
</div>
@endsection

{{-- @section('plugins.Select2', true) --}}

@section('js')
<script type="text/javascript">
  $(document).ready(function () {
      $('select').select2();

      let today = new Date();
      let d = today.getDay();
      let m = today.getMonth() + 1;
      let y = today.getFullYear();
      let h = today.getHours();
      let mm = today.getMinutes();

      $('.date').html(d + '/' + m + '/' + y + ' às ' + h + ':' + mm);

      // State -> Cite
      $('select[name=state_id]').change(function () {
        let idState = $(this).val();
        $.get('/get-cidades/' + idState, function (cidades) {
          $('select[name=cite_id]').empty();
          $('#cite_id').append('<option value="0" selected="selected">Selecione a Cidade</option>');
          $.each(cidades, function (key, value) {
            $('select[name=cite_id]').append('<option value=' + value.id + '>' + value.title + '</option>').prop('disabled', false);
          });
        });
      });

      // Client -> SubClient
      $('select[name=client_id]').change(function () {
        let idClient = $(this).val();
        $.get('/getSubClient/' + idClient, function (subclient) {
          $('select[name=sub_client_id]').empty();
					$('#sub_client_id').append('<option value="0" selected disabled>Selecione o SubCliente</option>');
          $.each(subclient, function (key, value) {
            $('select[name=sub_client_id]').append('<option value=' + value.id + '>' + value.name + '</option>').prop('disabled', false);
          });
        });
      });

		// SubClient -> Agency
		$('select[name=sub_client_id]').change(function () {
			$('select[name=agency]').prop('disabled', false);
		});


      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $(document).on('show.bs.modal', function(){
      	$('.modal-content').addClass('flipInX').removeClass('flipOutX')
			});
      $(document).on('hidden.bs.modal', function () {
        $("input[name=name]").val("");
        $("input[name=email]").val("");
				$('.modal-content').addClass('flipOutX').removeClass('flipInX')
      });

      $(".btn-submit").click(function (e) {
        e.preventDefault();

        var name = $("input[name=name]").val();
        var email = $("input[name=email]").val();

        $.ajax({
          type: 'POST',
          url: '/ajaxpost',
          data: {name: name, email: email},

          success: function (data) {
            getTec();
            $('#tecnicoModal').modal('hide').on('hide.bs.modal', function () {
              $("input[name=name]").val("");
              $("input[name=email]").val("");
            });
          },
          fail: function (data) {
            let response = JSON.parse(data.statusText)
            alert(response.error)
          }

        });
      });

      function getTec() {
        $('#tecnico_id').find('option').remove().end();
        var info = $.get('/gettecnicos');
        $('#tecnico_id').append('<option value="0"selected="selected">Selecione o Técnico</option>');
        info.done(function (data) {
          $.each(data, function (index, subObj) {
            $('#tecnico_id').append('<option value="' + subObj.id + '">' + subObj.name + '</option>');
          });
          // $('#tecnico_id').selectpicker('refresh');
        });
        info.fail(function () {
          alert('fdf');
        });
      }
    })
</script>
@stop
