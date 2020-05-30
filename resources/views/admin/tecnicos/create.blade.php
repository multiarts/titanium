@extends('layouts.app')

@push('css')
<!-- Latest compiled and minified CSS -->
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css"> --}}
@endpush

@section('content')

<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">

					<div class="card-header card-header-primary">
						<h4 class="title">Novo Técnico</h4>
					</div>

					<div class="card-body">
						<form action="{{ route('dashboard.tecnicos.store') }}" method="post">
							@csrf

							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="name">Nome</label>
									<input id="name" type="text"
										class="form-control @error('name') is-invalid @enderror" name="name"
										value="{{ old('name') }}" required>

									@error('name')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>

								<div class="form-group col-md-6">
									<label for="email">E-mail</label>
									<input id="email" type="email"
										class="form-control @error('email') is-invalid @enderror" name="email"
										value="{{ old('email') }}" required>

									@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>

							</div>

							{{-- <br> --}}

							<div class="form-row">
								<div class="form-group col-md-2">
									<label for="telefone">Telefone</label>
									<input id="telefone" type="phone"
										class="form-control @error('telefone') is-invalid @enderror" name="telefone"
										value="{{ old('telefone') }}" required>

									@error('telefone')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>

								<div class="form-group col-md-2">
									<label for="telefone1">Celular</label>
									<input id="telefone1" type="phone"
										class="form-control @error('telefone1') is-invalid @enderror" name="telefone1"
										value="{{ old('telefone1') }}" required>

									@error('telefone1')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>

								<div class="form-group col-md-3">
									<label for="rg">RG</label>
									<input id="rg" type="text" class="form-control @error('rg') is-invalid @enderror"
										name="rg" value="{{ old('rg') }}" required>

									@error('rg')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>

								<div class="form-group col-md-3">
									<label for="cpf">CPF</label>
									<input id="cpf" type="text" class="form-control @error('cpf') is-invalid @enderror"
										name="cpf" value="{{ old('cpf') }}" required>

									@error('cpf')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
							</div>

							{{-- <br> --}}

							<div class="form-row">
								<div class=" col-md-6">
									<label for="address">Endereço</label>
									<input id="address" type="text"
										class="form-control @error('address') is-invalid @enderror" name="address"
										value="{{ old('address') }}" required>

									@error('address')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>

								<div class="form-group col-md-2">
									<label for="state_id">Estado</label>
									<select name="state_id" id="state_id" class="form-control selectpicker" data-style="btn btn-sm btn-primary btn-round" title="Selecione a cidade"
									data-live-search="true" data-width="fit" data-size="5">
										<option value="0" selected>
											Escolha o estado</option>
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

								<div class="form-group col-md-3 ml-auto">
									<label for="cities_id">Cidade</label>
									<select name="cities_id" id="cities_id" class="form-control selectpickers" data-style="btn btn-sm btn-primary btn-round" title="Selecione a cidade"
									data-live-search="true" data-width="fit" data-size="5">
										<option value="" selected>Primeiro selecione o estado</option>
									</select>

									@error('cities_id')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>

							</div>

							{{-- <br> --}}

							<div class="form-row">

								<div class="form-group col-md-4">
									<label for="agencia">Agencia</label>
									<input id="agencia" type="text"
										class="form-control @error('agencia') is-invalid @enderror" name="agencia"
										value="{{ old('agencia') }}" required>

									@error('agencia')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>

								<div class="form-group col-md-4">
									<label for="numconta">Número da conta</label>
									<input id="numconta" type="text"
										class="form-control @error('numconta') is-invalid @enderror" name="numconta"
										value="{{ old('numconta') }}" required>

									@error('numconta')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>

								<div class="form-group col-md-4">
									<label for="numbanco">Número do banco</label>
									<input id="numbanco" type="text"
										class="form-control @error('numbanco') is-invalid @enderror" name="numbanco"
										value="{{ old('numbanco') }}" required>

									@error('numbanco')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>

							</div>

							{{-- <br> --}}

							<div class="form-row">

								<div class="form-group col-md-4">
									<label for="operacao">Operação</label>
									<input id="operacao" type="text"
										class="form-control @error('operacao') is-invalid @enderror" name="operacao"
										value="{{ old('operacao') }}" required>

									@error('operacao')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>

								<div class="form-group col-md-4">
									<label for="tipo">Tipo da conta</label>
									<select name="tipo" id="tipo" class="form-control selectpikers" required data-style="btn btn-sm btn-primary btn-round" title="Selecione o tipo de conta"
									data-live-search="true" data-width="fit" data-size="5">
										<option value="">Selecione o tipo de conta</option>
										<option value="0">Poupança</option>
										<option value="1">Corrente</option>
									</select>

									@error('tipo')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>

								<div class="form-group col-md-4">
									<label for="favorecido">Favorecido</label>
									<input id="favorecido" type="text"
										class="form-control @error('favorecido') is-invalid @enderror" name="favorecido"
										value="{{ old('favorecido') }}" required>

									@error('favorecido')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>

							</div>

							
							<button type="submit" class="btn btn-primary">
								Cadastrar
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
{{-- <script src="{{ asset('backend/js/plugins/bootstrap-selectpicker.js') }}"></script> --}}
{{-- <script src="https://demos.creative-tim.com/material-dashboard/assets/js/plugins/bootstrap-selectpicker.js"></script> --}}
<script type="text/javascript">
	$(document).ready(function() {
		// $('select').selectpicker();
		$('select[name=state_id]').change(function (){
			var idEstado = $(this).val();
			$.get('/get-cidades/' + idEstado, function (cidades){
				$('select[name=cities_id]').empty();
				// $('#cities_id').addClass('selectpicker');.selectpicker('render');
				$('#cities_id').append('<option value="0"selected="selected">Selecione a Cidade</option>');
				$('#cities_id').append('<option value="0">---------------------</option>');
				$.each(cidades, function (key, value){
					$('select[name=cities_id]').append('<option value=' + value.id + '>' + value.title + '</option>').prop('disabled', false);
					$('select[name=cities_id] .dropdown .bootstrap-select ul.dropdown-menu').append('<li><a class="dropdown-item"><span class="bs-ok-default check-mark"></span><span class="text">'+ value.title +'</span></a></li>')
				});
				});
			}
		);
	})
</script>
@endpush