@extends('layouts.app')

@include('partials.adminlte.css')

@section('content')
<div class="content">

	{{-- @include('partials.breadcrumbs') --}}

	@include('partials.toast')

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<form method="POST" action="{{ route('analistas.profile.update', $user->id) }}">
					@csrf
					@method('PATCH')

					<div class="card">
						<div class="card-header card-header-titanium">
							<h4 class="card-title">Perfil de usuário :: {{ $user->name }}</h4>
						</div>

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
									<label for="username">Username</label>
									<div class="form-group">
										<input class="form-control" name="username" id="username" type="text"
											placeholder="Username" value="{{ $user->username }}" required
											aria-required="true">
									</div>
								</div>

							</div>

							<div class="form-row">
								<div class="col-sm-4">
									<label for="email">Email</label>
									<div class="form-group bmd-form-group is-filled">
										<input class="form-control" name="email" id="email" type="email" placeholder="email" value="{{ $user->email }}">
									</div>
								</div>

								<div class="col-sm-4">
									<label for="password">Senha</label>
									<div class="form-group bmd-form-group is-filled">
										<input class="form-control" name="password" id="password" type="password" placeholder="password" value="">
									</div>
								</div>

							</div>

						</div> {{-- card-body --}}
						<div class="card-footer ml-auto mr-auto">
							{{-- <button type="submit" class="btn btn-warning">Salvar</button> --}}
							<button class="btn btn-warning btn-fill btn-round"
								onclick='swal({ title:"Sucesso!", text: "Atualizado com sucesso!", type: "success", buttonsStyling: false, confirmButtonClass: "btn btn-success"})'>
								<i class="material-icons">save</i>
								Salvar alterações
							</button>
						</div>
					</div>
				</form>
				{{-- @include('partials.alerts') --}}
			</div>
		</div>
	</div>
</div>
@endsection

@include('partials.adminlte.scripts')
@push('scripts')
<!--  Plugin for Sweet Alert -->
<script src="https://demos.creative-tim.com/material-dashboard/assets/js/plugins/sweetalert2.js"></script>
@endpush