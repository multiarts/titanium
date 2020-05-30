@extends('adminlte::page')

@section('title', 'Dashboard')

@section('css')
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css"> --}}
@stop

@section('content_header')
<div class="row mb-2">
	<div class="col-sm-6">
		{{-- <h1 class="m-0 text-dark">Editar</h1> --}}
	</div><!-- /.col -->
	<div class="col-sm-6">
		<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item"><a href="{{ route('dashboard.') }}" title="Dashboard" class="text-cyan"><i class="fas fa-home"></i></a></li>
			<li class="breadcrumb-item"><a href="{{ route('dashboard.chamados.index') }}" class="text-cyan">Chamados</a></li>
			<li class="breadcrumb-item active">{{ $chamado->number }}</li>
		</ol>
	</div><!-- /.col -->
</div>
@stop

@section('content')
<div class="content">

	{{-- @include('partials.toast') --}}

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">
							Chamado: <strong>{{ $chamado->number }}</strong>
						</h4>
					</div>
					<div class="card-body">
						<div class="table-reponsive">
							<form action="{{ route('dashboard.chamados.update', $chamado->id) }}" method="POST">
								@csrf
								@method('PUT')

								{{-- <div class="form-row">
											<div class="col-md-6">
												<label for="email" >Email</label>
													<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $chamado->number }}"
								required autocomplete="email" >

								@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
						</div>
					</div> --}}

					<div class="form-row">

						<div class="col-md-2">
							<label for="number"><i class="fa fa-hashtag"></i> Nº do chamado</label>
							<div class="bmd-form-group-sm{{ $errors->has('number') ? ' has-danger' : '' }}">
								<input name="number" id="number" type="text" placeholder="Número do chamado"
									class="form-control form-control-sm" value="{{ old('number') ?? $chamado->number }}"
									required autofocus>
							</div>
						</div>

						<div class="col-md-2">
							<label for="status" class="text-{{ $chamado->present()->statusAlert }}"><i
									class="fa fa-info-circle"></i> Status</label>
							<div class="bmd-form-group">
								<select name="status" id="status" type="text" placeholder="Número do chamado"
									class="form-control form-control-sm selectpicker show-tick"
									data-style="select-with-transitiona btn btn-sm btn-{{ $chamado->present()->statusAlert }}"
									title="Status" required>
									<option value="{{ old('status') ?? $chamado->status }}" selected>
										{{ $chamado->present()->statusSimple }}</option>
									<option value="0">Aberto</option>
									<option value="1">Concluído</option>
									<option value="2">Pendente</option>
								</select>
							</div>
						</div>

						<div class="col-md-3">
							<label for="dt_scheduling"><i class="fa fa-calendar-check-o"></i> Agendamento</label>
							<div class="bmd-form-group-sm">
								<input name="dt_scheduling" id="dt_scheduling" type="date"
									placeholder="dt_scheduling do chamado" class="form-control form-control-sm"
									value="{{ old('dt_scheduling') ?? date('Y-m-d', strtotime($chamado->dt_scheduling)) }}"
									required>
							</div>
						</div>

						<div class="col-md-2">
							<label for="state_id"><i class="fa fa-map-marker"></i> Estado</label>
							<div class="bmd-form-group{{ $errors->has('state_id') ? ' has-danger' : '' }}">
								<select name="state_id" id="state_id"
									class="form-control form-control-sm selectpicker show-tick" data-size="5"
									data-style="btn-outline-primary" title="Estado"
									data-live-search="true" data-placeholder="Selecione um estado">
									<option value="{{ $chamado->state_id }}" selected>
										{{ $chamado->state->title }}</option>
									@foreach ($estado as $key => $uf)
									<option value="{{ $key }}">{{ $uf }}</option>
									@endforeach
								</select>

								@error('state_id')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="col-md-3">
							<label for="cite_id"><i class="fa fa-map-marker"></i> Cidade</label>
							<div class="bmd-form-group{{ $errors->has('cite_id') ? ' has-danger' : '' }}">
								<select disabled name="cite_id" id="cite_id"
									class="form-control form-control-sm selectpicker show-tick" data-size="5"
									data-style="select-with-transitiona btn btn-sm btn-outline-primary" title="Cidade"
									data-live-search="true"  data-placeholder="Selecione a cidade">
									<option value="{{ $chamado->cite_id }}" selected>
										{{ $chamado->city->title }}</option>
								</select>

								@error('cite_id')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

					</div>

					<br>

					<div class="form-row">

						<div class="col-md-3">
							<label for="tecnico_id"><i class="fa fa-address-card"></i> Técnico</label>
							<div class="bmd-form-group-sm{{ $errors->has('tecnico_id') ? ' has-danger' : '' }}">
								<select name="tecnico_id" id="tecnico_id"
									class="form-control form-control-sm selectpicker show-tick" data-size="5"
									data-style="select-with-transitiona btn btn-sm btn-outline-primary" title="Técnico"
									data-live-search="true">
									<option value="{{ $chamado->tecnico_id }}" selected>
										{{ $chamado->tecnico->name }}</option>
									@foreach ($tecnicos as $key => $tec)
									<option value="{{ $key }}">{{ $tec }}</option>
									@endforeach
								</select>

								@error('tecnico_id')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="col-md-2">
							<label for="valor"><i class="fa fa-money"></i> Valor</label>
							<div class="bmd-form-group-sm{{ $errors->has('valor') ? ' has-danger' : '' }}">
								<input id="valor" type="text" placeholder="Valor do chamado"
									class="form-control form-control-sm" name="valor"
									value="{{ old('valor') ?? $chamado->valor }}" required>
							</div>
						</div>
						<div class="col-md-2">
							<label for="valorkm"><i class="fa fa-money"></i> Valor KM</label>
							<div class="bmd-form-group{{ $errors->has('valorkm') ? ' has-danger' : '' }}">
								<input name="valorkm" id="valorkm" type="text" placeholder="Valor do KM"
									class="form-control form-control-sm"
									value="{{ old('valorkm') ?? $chamado->valorkm }}">
							</div>
						</div>

						<div class="col-md-3">
							<label for="user_id"><i class="fa fa-user"></i> Analista</label>
							<div class="bmd-form-group{{ $errors->has('user_id') ? ' has-danger' : '' }}">
								<select name="user_id" id="user_id"
									class="form-control form-control-sm selectpicker show-tick" data-size="5"
									data-style="select-with-transitiona form-control form-control-sm" title="Analista"
									data-live-search="true">
									<option value="{{ $chamado->user_id }}" selected>
										{{ $chamado->analista->name }}</option>
									@foreach ($users as $key => $user)
									<option value="{{ $key }}">{{ $user }}</option>
									@endforeach
								</select>
							</div>
						</div>

					</div>

					<br>

					<div class="form-row">
						<div class="col-md-2">
							<label for="agencia">Agência</label>
							<div class="bmd-form-group-sm{{ $errors->has('agencia') ? ' has-danger' : '' }}">
								<input id="agencia" type="text" placeholder="Agência"
									class="form-control form-control-sm" name="agencia"
									value="{{ old('agencia') ?? $chamado->agencia }}" required>
							</div>
						</div>

						<div class="col-md-2">
							<label for="cep"><i class="fa fa-user"></i> CEP</label>
							<div class="bmd-form-group-sm{{ $errors->has('cep') ? ' has-danger' : '' }}">
								<input id="cep" type="text" placeholder="CEP" class="form-control form-control-sm"
									name="cep" value="{{ old('cep') ?? $chamado->cep }}">
							</div>
						</div>

						<div class="col-md-4">
							<label for="endereco"><i class="fa fa-building fa-xs"></i> Endereço</label>
							<div class="bmd-form-group-sm{{ $errors->has('endereco') ? ' has-danger' : '' }}">
								<div class="input-group">
									<input id="endereco" type="text" placeholder="Endereço do banco"
										class="form-control form-control-sm" name="endereco"
										value="{{ old('endereco') ?? $chamado->endereco }}" required>
								</div>
							</div>
						</div>

					</div>

					<br>

					<div class="form-row">
						<div class="col-md-12">
							<label for="observacao"><i class="fa fa-comment"></i> Acompanhamento</label>
							<div class="bmd-form-groupa{{ $errors->has('observacao') ? ' has-danger' : '' }}">
								<div class="input-group">
									<textarea id="observacao" placeholder="Observações" rows="6" cols="80"
										class="form-control form-control-sm{{ $errors->has('observacao') ? ' is-invalid' : '' }} "
										name="observacao">{!! $chamado->observacao !!}</textarea>
								</div>
							</div>
						</div>
					</div>

					<br>

					<button type="submit" class="btn btn-success btn-sm">
						<i class="material-icons">refresh</i> Atualizar
					</button>

					@can('gerente')
					<a href="{{ route('dashboard.chamados.index') }}" class="btn btn-sm btn-danger">
						<i class="material-icons">close</i> Cancelar
					</a>
					@elsecan('analistas')
					<a href="{{ route('analistas.chamados.index') }}" class="btn btn-sm btn-danger">
						<i class="material-icons">close</i> Cancelar
					</a>
					@endcan

					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
@endsection

@section('load_js')
{{-- <script src="{{ secure_asset('backend/js/wysiwyg.js') }}"></script> --}}
{{-- <script src="https://cdn.tiny.cloud/1/t5tdae6qnduiu8n6ms7etjz7ts0hha1en9j17qdlwcwpat5h/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> --}}
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
{{-- <script src="{{ asset('js/bootstrap-selectpicker.js') }}"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script> --}}
<script>
	$(document).ready(function(){
		$('select').select2();

		today = new Date();
		y = today.getFullYear();
		m = today.getMonth() + 1;
		d = today.getDate();
		h = today.getHours();
		min = today.getMinutes();

		// tinymce.init({selector:'textarea'});
		CKEDITOR.replace( 'observacao', {
			language: 'pt-br',
			width: '100%',
			// height: 500
			toolbarGroups: [{
				"name": "basicstyles",
				"groups": ["basicstyles"]
			}]

		});

		var txt = $('textarea#observacao');
			txt.val(txt.val() + "\n<b><ins><i>{{ auth()->user()->name }} -- "+ d+'/'+m+'/'+y+' as '+h+':'+min+'hs</i></ins></b><br>[Continue editando a partir daqui]');
		$('#state_id').on('change',function(e){

			$('#cite_id').find('option').remove().end();
			var cat_id = $('#state_id option:selected').attr('value');

			var info=$.get('/get-cidades/' + cat_id);
			info.done(function(data){
				$.each(data,function(index,subcatObj){
					$('#cite_id').append('<option value="'+subcatObj.id+'">'+	subcatObj.title+'</option>').prop('disabled', false);
				});
				// $('select[name=cite_id]').selectpicker('refresh');
			});
			info.fail(function(){
				// alert('ok');
				Swal.fire('Erro','Houve merda', 'error', );
			});
		});
	});
</script>
@stop