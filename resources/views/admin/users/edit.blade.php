@extends('adminlte::page')

@section('title', 'Analistas')

@section('content_header')
	<div class="row mb-2">
		<div class="col-sm-6">
			<h1 class="m-0 text-dark">Analistas</h1>
		</div><!-- /.col -->
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="{{ route('dashboard.') }}"><i class="fad fa-home"></i></a></li>
				<li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">Analistas</a></li>
				<li class="breadcrumb-item active">{{ $user->name }}</li>
			</ol>
		</div><!-- /.col -->
	</div>
@stop

@section('content')
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8">
					<div class="card">
						<div class="card-header">
							<div class="card-text">
								<h4 class="card-title">
									Editando {{ $user->name }}
								</h4>
							</div>
						</div>
						<div class="card-body">
							<div class="table-reponsive">
								<form action="{{ route('dashboard.users.update', $user->username) }}" method="POST">
									@csrf
									@method('PUT')

									<div class="form-row">
										<div class="col-md-6">
											<label for="email">Email</label>
											<input id="email" type="email"
														 class="form-control @error('email') is-invalid @enderror" name="email"
														 value="{{ $user->email }}" required autocomplete="email" autofocus>
											@error('email')
											<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
											@enderror
										</div>

										<div class="col-md-6">
											<label for="name">Nome</label>
											<input id="name" type="text"
														 class="form-control @error('name') is-invalid @enderror" name="name"
														 value="{{ $user->name }}" required>

											@error('name')
											<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
											@enderror
										</div>
									</div>

									<div class="form-row">
										<div class="col-md-6">
											<label for="username">Usuário login</label>
											<input id="username" type="text"
														 class="form-control @error('username') is-invalid @enderror" name="username"
														 value="{{ $user->username }}">

											@error('username')
											<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
											@enderror
										</div>

										<div class="col-md-6">
											<label for="password">Senha</label>
											<input id="password" type="password"
														 class="form-control @error('password') is-invalid @enderror" name="password"
														 value="">

											@error('password')
											<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
											@enderror
										</div>


										{{-- <div class="col-md-6">
											<label for="current_password">Senha atual</label>
											<input id="current_password" type="password"
														 class="form-control  @error('current_password') is-invalid @enderror"
														 name="current_password">

											@error('current_password')
											<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
											@enderror
										</div> --}}
									</div>

									<div class="form-row">
										


										{{-- <div class="col-md-6">
											<label for="password-confirm">Confirm Password</label>
											<input id="password-confirm" type="password" class="form-control"
														 name="password_confirmation">
										</div> --}}

									</div>

							<div class="form-row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label">Permissões</label>
										<div class="col-md-8">
											@foreach ($roles as $role)
												<div class="form-check form-check-inline icheck-olive">
													<input type="checkbox" id="{{ $role->name }}" name="roles[]" value="{{ $role->id }}" @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
													<label for="{{ $role->name }}">{{ ucfirst($role->name) }}</label>
												</div>
											@endforeach
										</div>

									</div>
								</div>
							</div>

							<button type="submit" class="btn btn-sm btn-flat btn-primary">
								<i class="fad fa-save"></i> Atualizar
							</button>
							<a href="{{ route('dashboard.users.index') }}" class="btn btn-sm btn-flat btn-danger">
								<i class="fad fa-times"></i>
								Cancelar
							</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop