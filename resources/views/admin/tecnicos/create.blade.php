@extends('adminlte::page')

@section('load_css')
@include('partials.css')
@stop

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
								<div class="col-md-6">
									<label for="name">Nome</label>
									<input id="name" type="text"
										class="form-control form-control-sm @error('name') is-invalid @enderror" name="name"
										value="{{ old('name') }}" required>

									@error('name')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>

								<div class="col-md-6">
									<label for="email">E-mail</label>
									<input id="email" type="email"
										class="form-control form-control-sm @error('email') is-invalid @enderror" name="email"
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
								<div class="col-md-2">
									<label for="telefone">Telefone</label>
									<input id="telefone" type="phone"
										class="form-control form-control-sm @error('telefone') is-invalid @enderror" name="telefone"
										value="{{ old('telefone') }}" required>

									@error('telefone')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>

								<div class="col-md-2">
									<label for="telefone1">Celular</label>
									<input id="telefone1" type="phone"
										class="form-control form-control-sm @error('telefone1') is-invalid @enderror" name="telefone1"
										value="{{ old('telefone1') }}" required>

									@error('telefone1')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>

								<div class="col-md-3">
									<label for="rg">RG</label>
									<input id="rg" type="text" class="form-control form-control-sm @error('rg') is-invalid @enderror"
										name="rg" value="{{ old('rg') }}" required>

									@error('rg')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>

								<div class="col-md-3">
									<label for="cpf">CPF</label>
									<input id="cpf" type="text" class="form-control form-control-sm @error('cpf') is-invalid @enderror"
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
										class="form-control form-control-sm @error('address') is-invalid @enderror" name="address"
										value="{{ old('address') }}" required>

									@error('address')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>

								<div class="col-md-2">
									<label for="state_id">Estado</label>
									<select name="state_id" id="state_id" class="form-control form-control-sm" title="Selecione a cidade">
										<option value="0" selected disabled>Escolha o estado</option>
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
									<label for="cite_id">Cidade</label>
									<select name="cite_id" id="cite_id" class="form-control form-control-sm" title="Selecione a cidade">
										<option value="" selected disabled>Primeiro selecione o estado</option>
									</select>

									@error('cite_id')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>

							</div>

							{{-- <br> --}}

							<div class="form-row">

								<div class="col-md-4">
									<label for="agencia">Agencia</label>
									<input id="agencia" type="text"
										class="form-control form-control-sm @error('agencia') is-invalid @enderror" name="agencia"
										value="{{ old('agencia') }}" required>

									@error('agencia')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>

								<div class="col-md-4">
									<label for="numconta">Número da conta</label>
									<input id="numconta" type="text"
										class="form-control form-control-sm @error('numconta') is-invalid @enderror" name="numconta"
										value="{{ old('numconta') }}" required>

									@error('numconta')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>

								<div class="col-md-4">
									<label for="numbanco">Número do banco</label>
									<input id="numbanco" type="text"
										class="form-control form-control-sm @error('numbanco') is-invalid @enderror" name="numbanco"
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

								<div class="col-md-4">
									<label for="operacao">Operação</label>
									<input id="operacao" type="text"
										class="form-control form-control-sm @error('operacao') is-invalid @enderror" name="operacao"
										value="{{ old('operacao') }}" required>

									@error('operacao')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>

								<div class="col-md-4">
									<label for="tipo">Tipo da conta</label>
									<select name="tipo" id="tipo" class="form-control form-control-sm" required title="Selecione o tipo de conta">
										<option value="" selected disabled>Selecione o tipo de conta</option>
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
										class="form-control form-control-sm @error('favorecido') is-invalid @enderror" name="favorecido"
										value="{{ old('favorecido') }}" required>

									@error('favorecido')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>

							</div>

							
							<button type="submit" class="btn btn-primary">
								<i class="fas fa-save"></i> Cadastrar
							</button>
							
								<a href="{{ route('dashboard.tecnicos.index') }}" class="btn btn-danger">
									<i class="fas fa-times"></i> Cancelar
								</a>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('load_js')
@include('partials.js')
@endsection