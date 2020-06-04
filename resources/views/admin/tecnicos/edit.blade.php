@extends('adminlte::page')

@section('load_css')
@include('partials.css')
@endsection

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
										<select name="active" id="active" class="form-control form-control-sm">
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
											class="form-control form-control-sm @error('name') is-invalid @enderror" name="name"
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
											class="form-control form-control-sm @error('email') is-invalid @enderror" name="email"
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
											class="form-control form-control-sm @error('telefone') is-invalid @enderror" name="telefone"
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
											class="form-control form-control-sm @error('telefone1') is-invalid @enderror"
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
											class="form-control form-control-sm @error('rg') is-invalid @enderror" name="rg"
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
											class="form-control form-control-sm @error('cpf') is-invalid @enderror" name="cpf"
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
											class="form-control form-control-sm @error('address') is-invalid @enderror" name="address"
											value="{{ $tecnico->address }}" required>

										@error('address')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>

									<div class="col-md-3">
										<label for="state_id">Estado</label>
										<select name="state_id" id="state_id" class="form-control form-control-sm" title="Estado" tabindex="-98" title="Estado">
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
										<label for="cite_id">Cidade</label>
										<select name="cite_id" id="cite_id"
											class="form-control form-control-sm" title="Cidade" tabindex="-98"
											data-live-search="true">
											<option value="{{ $tecnico->citie->id ?? '' }}"
												selected>{{ $tecnico->citie->title ?? ''}}
											</option>
										</select>

										@error('cite_id')
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
											class="form-control form-control-sm @error('agencia') is-invalid @enderror" name="agencia"
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
											class="form-control form-control-sm @error('numconta') is-invalid @enderror" name="numconta"
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
											class="form-control form-control-sm @error('numbanco') is-invalid @enderror" name="numbanco"
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
											class="form-control form-control-sm @error('operacao') is-invalid @enderror" name="operacao"
											value="{{ $tecnico->operacao }}" required>

										@error('operacao')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>

									<div class="col-md-4">
										<label for="tipo">Tipo da conta</label>
										<select name="tipo" id="tipo" class="form-control form-control-sm" required>
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
											class="form-control form-control-sm @error('favorecido') is-invalid @enderror"
											name="favorecido" value="{{ $tecnico->favorecido }}">

										@error('favorecido')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>

								</div>

								<button type="submit" class="btn btn-primary">
									<i class="fas fa-save"></i> Atualizar
								</button>

									<a href="{{ route('dashboard.tecnicos.index') }}" class="btn btn-danger">
										<i class="fas fa-times"></i> cancelar
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