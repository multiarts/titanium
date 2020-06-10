@extends('adminlte::page')

@section('load_css')
@include('partials.css')
@stop

@section('title', 'Meu perfil')

@section('content_header')
<div class="row mb-2">
	<div class="col-sm-6">
		<h1 class="m-0 text-dark">Perfil</h1>
	</div><!-- /.col -->
	<div class="col-sm-6">
		<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item"><a href="{{ route('dashboard.chamados.index') }}" title="Chamados"
					class="text-cyan"><i class="fas fa-home"></i></a></li>
			<li class="breadcrumb-item active">{{ $user->name }}</li>
		</ol>
	</div><!-- /.col -->
</div>
@stop

@section('content')
<div class="row">
	<div class="col-md-9">
		<form method="POST" action="{{ route('dashboard.perfil.update', $user->id) }}">
			@csrf
			@method('PATCH')

			<div class="card card-navy card-outline">
				{{-- <div class="card-header card-header-titanium">
							<h4 class="card-title">Perfil de usuário :: {{ $user->name }}</h4>
			</div> --}}

			<div class="card-body">

				{{-- <input type="hidden" name="name" value="{{ $user->name }}"> --}}

				<div class="form-row">
					<div class="col-md-4">
						<label for="name">Nome</label>
						<div class="form-group bmd-form-group is-filled">
							<input class="form-control" name="name" id="name" type="text" placeholder="name"
								value="{{ $user->name }}" required aria-required="true">
						</div>
					</div>

					<div class="col-md-4">
						<label for="username">Usuário de login</label>
						<div class="form-group">
							<input class="form-control" name="username" id="username" type="text" placeholder="Username"
								value="{{ $user->username }}" required aria-required="true">
						</div>
					</div>

				</div>

				<div class="form-row">
					<div class="col-sm-4">
						<label for="email">Email</label>
						<div class="form-group bmd-form-group is-filled">
							<input class="form-control" name="email" id="email" type="email" placeholder="email"
								value="{{ $user->email }}">
						</div>
					</div>

					<div class="col-sm-4">
						<label for="password">Senha</label>
						<div class="form-group bmd-form-group is-filled">
							<input class="form-control" name="password" id="password" type="password"
								placeholder="Senha" value="">
						</div>
					</div>

				</div>

				<button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Atualizar</button>

			</div> {{-- card-body --}}
			
		</form>
	</div>

</div>
<div class="col-md-3">
	<div class="card card-navy card-outline">
		<div class="card-body box-profile">
			<div class="text-center">
				@if(!$user->image) 
				<img src="{{ $user->adminlte_image() }}" alt="{{ $user->name }}"
					class="profile-user-img img-fluid img-circle">
				@else
				<img src="{{ url("storage/{$user->image}") }}" alt="{{ $user->name }}"
					class="profile-user-img img-fluid img-circle">
				@endif
			</div>
			<h3 class="profile-username text-center">{{ $user->name }}</h3>
			<p class="text-muted text-center">
				@foreach($user->roles as $role)
				<span class="badge badge-info">
					{!! ucfirst($role->name) !!}
				</span>
				@endforeach
			</p>
			<ul class="list-group list-group-unbordered mb-3">
				<li class="list-group-item">
					<b>Chamados</b> <a class="float-right">{{ $chamados->count() }}</a>
				</li>
				<li class="list-group-item">
					<b>Abertos</b> <a class="float-right">{{ $chamados->where('status', 0)->count() }}</a>
				</li>
				<li class="list-group-item">
					<b>Concluídos</b> <a class="float-right">{{ $chamados->where('status', 1)->count() }}</a>
				</li>
				<li class="list-group-item">
					<b>Pendentes</b> <a class="float-right">{{ $chamados->where('status', 2)->count() }}</a>
				</li>
			</ul>
			<a href="#" class="btn btn-danger btn-block" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-fw fa-power-off"></i> <b>Desconectar</b></a>
		</div>
	</div>
</div>
@endsection