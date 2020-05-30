@extends('layouts.app')

@section('content')
<div class="content">

	{{-- @include('partials.breadcrumbs') --}}

    <div class="container-fluid">
			<div class="row">
				<div class="col-md-8">
					<div class="card">
						<div class="card-header card-header-text card-header-primary">
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
												<label for="email" >Email</label>
													<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>

													@error('email')
														<span class="invalid-feedback" role="alert">
															<strong>{{ $message }}</strong>
														</span>
													@enderror
											</div>
											
											<div class="col-md-6">
												<label for="name">Nome</label>
													<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required>

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
												<input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}" required>

												@error('username')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>

											<div class="col-md-6">
												<label for="password">Senha</label>
												<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="">

												@error('password')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
												</div>
											</div>
										</div>

										<div class="form-row">
											<div class="col-md-12">
												<div class="form-check">
													<label class="col-md-2 control-label">Permissões</label>
													<div class="col-md-6">
													@foreach ($roles as $role)
														<div class="form-check form-check-inline">
															<label class="form-check-label">
																<input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}"
																@if($user->roles->pluck('id')->contains($role->id)) checked @endif>
																{{ $role->name }}
																<span class="form-check-sign">
																	<span class="check"></span>
																</span>
															</label>
														</div>                        
													@endforeach
												</div>
											</div>
											</div>
										</div>

										<button type="submit" class="btn btn-primary">
											<i class="material-icons">refresh</i> Atualizar
										</button>
								</form>
								</div>		
							</div>
					</div>
				</div>
			</div>
    </div>
</div>
@endsection
