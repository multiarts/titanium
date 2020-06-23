@extends('adminlte::page')

@section('title', "Chamado {$chamado->number}")

@section('content_header')
<div class="row mb-2">
	<div class="col-sm-6">
		{{-- <h1 class="m-0 text-dark">Editar</h1> --}}
	</div><!-- /.col -->
	<div class="col-sm-6">
		<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item">
				<a href="{{ route('dashboard.') }}" title="Painel de controle" class="text-cyan">
					<i class="fad fa-home"></i>
				</a>
			</li>
			<li class="breadcrumb-item">
				<a href="{{ route('dashboard.chamados.index') }}" class="text-cyan">Chamados</a>
			</li>
			<li class="breadcrumb-item active">{{ $chamado->number }}</li>
		</ol>
	</div><!-- /.col -->
</div>
@stop

@section('content')
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<form action="{{ route('dashboard.chamados.update', $chamado->id) }}" method="POST" class="form">
					@csrf
					@method('PUT')
					<div class="card card-outline card-navy">
						<div class="card-header">
							<div class="d-flex justify-content-between">
								<h4 class="card-title">
									Chamado: <strong
										class="text-{{ $chamado->present()->statusAlert }}">{{ $chamado->number }}</strong>
								</h4>
								<div class="col-md-3">
									<label for="status" class="text-{{ $chamado->present()->statusAlert }}"><i
											class="fa fa-info-circle"></i> Status</label>
									<select name="status" id="status" type="text" class="form-control form-control-sm"
										title="Status" required>
										<option value="{{ old('status') ?? $chamado->status }}" selected>
											{{ $chamado->present()->statusSimple }}</option>
										<option value="0">Aberto</option>
										<option value="1">Concluído</option>
										<option value="2">Pendente</option>
									</select>
								</div>
							</div>

						</div>
						<div class="card-body">
							<div class="form-row">
								<div class="col-md-2">
									<label for="number">Nº do chamado</label>
									<input name="number" id="number" type="text" placeholder="Número do chamado"
										class="form-control form-control-sm"
										value="{{ old('number') ?? $chamado->number }}" required autofocus>
								</div>


								<div class="col-md-3">
									<label for="client_id">Cliente</label>
									<select name="client_id" id="client_id" class="form-control form-control-sm">
										<option value="{{ $chamado->client_id }}" selected>{{ $chamado->client->name }}
										</option>
										@foreach ($clients as $key => $client)
										<option value="{{ $key }}">{{ $client }}</option>
										@endforeach
									</select>
								</div>

								<div class="col-md-3">
									<label for="sub_client_id">Subcliente</label>
									<select name="sub_client_id" id="sub_client_id"
										class="form-control form-control-sm">
										<option value="{{ $chamado->sub_client_id }}" selected>
											{{ $chamado->subClient->name }}</option>
									</select>
								</div>

								{{-- <div class="col-md-2"><label for="agency_id">Agência</label>
									<select name="agency_id" id="agency_id" class="form-control form-control-sm">
										<option value="{{ $chamado->agency->id }}" selected>{{ $chamado->agency->name }}
										</option>
										@foreach ($agencies as $key => $ag)
										<option value="{{ $key }}">{{ $ag }}</option>
										@endforeach
									</select>
								</div> --}}

								<div class="col-md-2"><label for="prefix">Prefixo</label>
									<input type="text" name="prefix" id="prefix" class="form-control form-control-sm" value="{{ $chamado->prefix }}">
								</div>

								<div class="col-md-2">
									<label for="sigla">Sigla</label>
									<input type="text" name="sigla" id="sigla" class="form-control form-control-sm"
										placeholder="Sigla" value="{{ $chamado->sigla }}">
								</div>

							</div>

							<br>

							<div class="form-row">
								<div class="col-md-3">
									<label for="start"><i class="fa fa-calendar-check-o"></i>
										Agendamento</label>
									<input name="start" id="start" type="date" class="form-control form-control-sm"
										value="{{ old('start') ?? date('Y-m-d', strtotime($chamado->start)) }}"
										required>
								</div>

								<div class="col-md-2">
									<label for="departure_time" class="label-control">H. do agendamento</label>
									<input name="departure_time" id="departure_time" type="time"
										placeholder="Hora do agendamento" class="form-control form-control-sm"
										value="{{ $chamado->departure_time }}" required>
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
										<input id="v_deslocamento" name="v_deslocamento" type="text"
											class="form-control form-control-sm" placeholder="R$30,00"
											value="{{ old('v_deslocamento') }}">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-groups">
										<label for="v_titanium" class="label-control">Valor Titanium</label>
										<input id="v_titanium" name="v_titanium" type="text"
											class="form-control form-control-sm" placeholder="R$30,00"
											value="{{ old('v_titanium') }}">
									</div>
								</div>
								@endcan

							</div>

							<br>

							<div class="form-row">

								<div class="col-md-3">
									<label for="tecnico_id">Técnico</label>
									<select name="tecnico_id" id="tecnico_id" class="form-control form-control-sm">
										<option value="{{ $chamado->tecnico_id }}" selected>
											{{ $chamado->tecnico->name }}</option>
										@foreach ($tecnicos as $tec)
										<option value="{{ $tec->id }}" @if($tec->active == 'off') disabled class="bg-danger" @endif>{{ $tec->name }}</option>
										@endforeach
									</select>
								</div>

								<div class="col-md-2">
									<label for="v_atendimento">Valor do atendimento</label>
									<input id="v_atendimento" type="text" placeholder="R$ 30,00"
										class="form-control form-control-sm" name="v_atendimento"
										value="{{ $chamado->v_atendimento }}" required>
								</div>

								<div class="col-md-2">
									<label for="v_km">Valor KM</label>
									<input type="text" name="v_km" id="v_km" class="form-control form-control-sm"
										placeholder="R$ 40,00" value="{{ $chamado->v_km }}">
								</div>

								<div class="col-md-4">
									<label for="user_id">Analista</label>
									<select name="user_id" id="user_id" class="form-control form-control-sm">
										<option value="{{ $chamado->user_id }}" selected>
											{{ $chamado->analista->name }}</option>
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
										placeholder="CEP" name="zipcode" value="{{ $chamado->zipcode }}">
								</div>

								<div class="col-md-4">
									<label for="address" class="control-label">Endereço</label><br>
									<input name="address" id="address" type="text" placeholder="Endereço do banco"
										class="form-control form-control-sm" value="{{ $chamado->address }}" required>
								</div>

								<div class="col-md-3">
									<label for="state_id">Estado</label>
									<select name="state_id" id="state_id" class="form-control form-control-sm">
										<option value="{{ $chamado->state_id }}" selected>{{ $chamado->state->title }}
										</option>
										@foreach($states as $key => $state)
										<option value="{{ $key }}">{{ $state }}</option>
										@endforeach
									</select>
								</div>

								<div class="col-md-2">
									<label for="cite_id">Cidade</label>
									<select name="cite_id" id="cite_id" class="form-control form-control-sm" disabled>
										<option value="{{ $chamado->cite_id }}" selected>{{ $chamado->city->title }}
										</option>
									</select>
								</div>

							</div>

							<br>

							<div class="form-row">
								<div class="col-md-3">
									<label for="occurrence">Ocorrência</label>
									<textarea name="occurrence" id="occurrence" type="text"
										class="form-control form-control-sm"
										placeholder="Digite a ocorrência relatada pelo Cliente." rows="3"
										cols="2">{{ $chamado->occurrence }}</textarea>
								</div>
								<div class="col-md-3">
									<label for="solution">Solução</label>
									<textarea name="solution" id="solution" type="text"
										class="form-control form-control-sm"
										placeholder="Digite a solução dada pelo Técnico no atendimento." rows="3"
										cols="2">{{ $chamado->solution }}</textarea>
								</div>
								<div class="col-md-2">
									<label for="responsavel">Responsável no local</label>
									<input name="responsavel" id="responsavel" type="text"
										class="form-control form-control-sm" placeholder="Nome do responsável local."
										value="{{ $chamado->responsavel }}">
								</div>
								<div class="col-md-2">
									<label for="tel_responsavel">Telefone Resp. local</label>
									<input name="tel_responsavel" id="tel_responsavel" type="tel"
										class="form-control form-control-sm" placeholder="Tel. do responsável local."
										value="{{ $chamado->tel_responsavel }}">
								</div>
							</div>

							<br>

							<div class="form-row">
								<div class="col-md-2">
									<label for="n_serie">Nº de série</label>
									<input name="serial" id="serial" type="text" class="form-control form-control-sm"
										placeholder="Número de série" value="{{ $chamado->serial }}">
								</div>
								<div class="col-md-2">
									<label for="model">Modelo</label>
									<input name="model" id="model" type="text" class="form-control form-control-sm"
										placeholder="Modelo do equipamento" value="{{ $chamado->model }}">
								</div>
								<div class="col-md-2">
									<label for="marca">Marca</label>
									<input name="marca" id="marca" type="text" class="form-control form-control-sm"
										placeholder="Marca" value="{{ $chamado->marca }}">
								</div>

								<div class="form-group">
									<div class="form-check form-check-inline icheck-olive">
										<input type="checkbox" name="documentacao"
											id="documentacao" value="{{ old('documentacao', $chamado->documentacao) }}"
											@if($chamado->documentacao == 'on') checked @endif>
											<label class="form-check-label" for="documentacao">Documentação ok?</label>
									
										
								</div>
								<div class="form-check form-check-inline icheck-olive">
									<input type="checkbox" name="produtiva" id="produtiva"
									value="{{ old('produtiva', $chamado->produtiva) }}" @if($chamado->produtiva
								== 'on') checked @endif>
							<label for="produtiva">Improdutiva</label>
								</div>		
							</div>
							</div>

							<br>

							<div class="form-row">
								<div class="col-md-6">
									<div class="form-grousp">
										<label for="rat">Anexar RAT</label>
										<input type="file" name="rat" id="rat" class="form-controla fileinput-inline">
									</div>
								</div>
							</div>

							<div class="form-row">
								<div class="col-md-12">
									<label for="observacao">Acompanhamento</label>
									<div class="bmd-form-group{{ $errors->has('observacao') ? ' has-danger' : '' }}">
										<div class="input-group">
											<textarea id="observacao" placeholder="Observações" rows="6" cols="80"
												class="form-control form-control-sm{{ $errors->has('observacao') ? ' is-invalid' : '' }} "
												name="observacao">{!! $chamado->observacao !!}</textarea>
										</div>
									</div>
								</div>
							</div>

							<br>

							<button type="submit" class="btn btn-flat btn-success btn-sm">
								<i class="fas fa-sync-alt"></i> Atualizar
							</button>

							<a href="{{ route('dashboard.chamados.index') }}" class="btn btn-flat btn-sm btn-danger">
								<i class="fas fa-times"></i> Cancelar
							</a>


						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">

@stop

@section('js')
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script>
	$(document).ready(function () {
			$('select').select2();

			today = new Date();
			y = today.getFullYear();
			m = today.getMonth() + 1;
			d = today.getDate();
			h = today.getHours();
			min = today.getMinutes();

			CKEDITOR.replace('observacao', {
				language: 'pt-br',
				width: '100%',
				// height: 500
				toolbarGroups: [{
					"name": "basicstyles",
					"groups": ["basicstyles"]
				}]

			});

			var txt = $('textarea#observacao');
			txt.val(txt.val() + "\n\r<b><ins><i>{{ auth()->user()->name }} -- " + d + '/' + m + '/' + y + ' as ' + h + ':' + min + 'hs</i></ins></b><br>[Continue editando a partir daqui]');
			$('#state_id').on('change', function (e) {

				$('#cite_id').find('option').remove().end();
				var cat_id = $('#state_id option:selected').attr('value');

				var info = $.get('/get-cidades/' + cat_id);
				info.done(function (data) {
					$.each(data, function (index, subcatObj) {
						$('#cite_id').append('<option value="' + subcatObj.id + '">' + subcatObj.title + '</option>').prop('disabled', false);
					});
				});
				info.fail(function () {
					// alert('ok');
				});
			});
		});
</script>
@stop