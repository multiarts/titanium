@extends('layouts.app')

@push('css')
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endpush

@section('content')
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header card-header-titanium card-header-text card-header-info">
						<div class="card-text">
							<h4 class="card-title">
								Editando {{ $tecnico->name }}
							</h4>
							<p class="card-category">
								Cadastrado em: {{ $tecnico->created_at }}
							</p>
						</div>
						
					</div>
					<div class="card-body">
						<div class="table-reponsive">
							<form action="{{ route('dashboard.tecnicos.update', $tecnico->id) }}" method="POST">
								@csrf
								@method('PATCH')

								<div class="form-row">
									<div class="col-md-3">
										<label for="active">Status</label>
										<select name="active" id="active" class="form-control">
											<option value="{{ $tecnico->active }}">{{ $tecnico->active ? 'Ativado' : 'Desativado' }}</option>
											<option value="0">Desativar</option>
											<option value="1">Ativar</option>
										</select>
									</div>
								</div>

								<div class="form-row">
									<div class="col-md-6">
										<label for="name">Nome</label>
										<input id="name" type="text"
											class="form-control @error('name') is-invalid @enderror" name="name"
											value="{{ old('name') ?? $tecnico->name }}" required>

										@error('name')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>

									<div class="col-md-6">
										<label for="email">E-mail</label>
										<input id="email" type="email"
											class="form-control @error('email') is-invalid @enderror" name="email"
											value="{{ old('email') ?? $tecnico->email }}" required>

										@error('email')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>

								</div>

								<br>

								<div class="form-row">
									<div class="col-md-2">
										<label for="telefone">Telefone</label>
										<input id="telefone" type="phone"
											class="form-control @error('telefone') is-invalid @enderror" name="telefone"
											value="{{ $tecnico->telefone }}" required>

										@error('telefone')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>

									<div class="col-md-2">
										<label for="telefone1">Celular</label>
										<input id="telefone1" type="phone"
											class="form-control @error('telefone1') is-invalid @enderror"
											name="telefone1" value="{{ $tecnico->telefone1 }}" required>

										@error('telefone1')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>

									<div class="col-md-3">
										<label for="rg">RG</label>
										<input id="rg" type="text"
											class="form-control @error('rg') is-invalid @enderror" name="rg"
											value="{{ $tecnico->rg }}">

										@error('rg')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>

									<div class="col-md-3">
										<label for="cpf">CPF</label>
										<input id="cpf" type="text"
											class="form-control @error('cpf') is-invalid @enderror" name="cpf"
											value="{{ $tecnico->cpf }}" required>

										@error('cpf')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
								</div>

								<br>

								<div class="form-row">
									<div class="col-md-6">
										<label for="address">Endereço</label>
										<input id="address" type="text"
											class="form-control @error('address') is-invalid @enderror" name="address"
											value="{{ $tecnico->address }}" required>

										@error('address')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>

									<div class="col-md-3">
										<label for="state_id">Estado</label>
										<select name="state_id" id="state_id" class="form-controls selectpicker show-tick" data-size="5" data-style="select-with-transitiona btn btn-sm btn-outline-primary" title="Estado" tabindex="-98" title="Estado" data-live-search="true">
											<option value="{{ $tecnico->estado->id ?? '' }}"
												selected>{{ $tecnico->estado->title ?? '' }}
											</option>
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

									<div class="col-md-3">
										<label for="cities_id">Cidade</label>
										<select name="cities_id" id="cities_id"
											class="selectpicker form-controls show-tick" data-size="5" data-style="select-with-transitions btn btn-sm btn-outline-primary" title="Cidade" tabindex="-98"
											data-live-search="true">
											<option value="{{ $tecnico->citie->id ?? '' }}"
												selected>{{ $tecnico->citie->title ?? ''}}
											</option>
										</select>

										@error('cities_id')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>

								</div>

								<br>

								<div class="form-row">

									<div class="col-md-4">
										<label for="agencia">Agencia</label>
										<input id="agencia" type="text"
											class="form-control @error('agencia') is-invalid @enderror" name="agencia"
											value="{{ $tecnico->agencia }}" required>

										@error('agencia')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>

									<div class="col-md-4">
										<label for="numconta">Número da conta</label>
										<input id="numconta" type="text"
											class="form-control @error('numconta') is-invalid @enderror" name="numconta"
											value="{{ $tecnico->numconta }}" required>

										@error('numconta')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>

									<div class="col-md-4">
										<label for="numbanco">Número do banco</label>
										<input id="numbanco" type="text"
											class="form-control @error('numbanco') is-invalid @enderror" name="numbanco"
											value="{{ $tecnico->numbanco }}" required>

										@error('numbanco')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>

								</div>

								<br>

								<div class="form-row">

									<div class="col-md-4">
										<label for="operacao">Operação</label>
										<input id="operacao" type="text"
											class="form-control @error('operacao') is-invalid @enderror" name="operacao"
											value="{{ $tecnico->operacao }}" required>

										@error('operacao')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>

									<div class="col-md-4">
										<label for="tipo">Tipo da conta</label>
										<select name="tipo" id="tipo" class="form-control" required>
											<option value="{{ $tecnico->tipo }}">
												{{ $tecnico->tipo ? 'Corrente' : 'Poupança' }}</option>
											<option value="0">Poupança</option>
											<option value="1">Corrente</option>
										</select>

										@error('tipo')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>

									<div class="col-md-4">
										<label for="favorecido">Favorecido</label>
										<input id="favorecido" type="text"
											class="form-control @error('favorecido') is-invalid @enderror"
											name="favorecido" value="{{ $tecnico->favorecido }}">

										@error('favorecido')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>

								</div>

								<button type="submit" class="btn btn-primary">
									<i class="material-icons">refresh</i> Atualizar
								</button>

								@can('gerente')
									<a href="{{ route('dashboard.tecnicos.index') }}" class="btn btn-danger">
										<i class="material-icons">close</i> cancelar
									</a>								
								@elsecan('analistas')
									<a href="{{ route('analistas.tecnicos.index') }}" class="btn btn-danger">
										<i class="material-icons">close</i> cancelar
									</a>									
								@endcan

							</form>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection
	@push('scripts')
	<script src="{{ asset('backend/js/plugins/bootstrap-selectpicker.js') }}"></script>
	<script>

	$('#state_id').on('change',function(e){
							
		$('#cities_id').find('option').remove().end();
		var cat_id = $('#state_id option:selected').attr('value');
	
		var info=$.get('/get-cidades/' + cat_id);
		info.done(function(data){
			$.each(data,function(index,subcatObj){
				$('#cities_id').append('<option value="'+subcatObj.id+'">'+	subcatObj.title+'</option>');
			});
			$('#cities_id').selectpicker('refresh');
		});
		info.fail(function(){
			alert('ok');
		});
	});
	</script>
	@endpush