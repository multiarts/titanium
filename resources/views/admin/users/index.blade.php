@extends('adminlte::page')

@section('title', 'Analistas')

@section('content_header')
	<div class="row mb-2">
		<div class="col-sm-6">
			<h1 class="m-0 text-dark">Analistas</h1>
		</div><!-- /.col -->
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="{{ route('dashboard.') }}"><i class="fas fa-home"></i></a></li>
				<li class="breadcrumb-item active">Analistas</li>
			</ol>
		</div><!-- /.col -->
	</div>
@stop

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header border-0">
					<div class="d-flex justify-content-between">
						<h3 class="card-title">Listagem de analistas</h3>
						<a href="" class="btn btn-sm btn-success">
							<i class="fas fa-plus"></i>Novo
						</a>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-12">
							@if ($users->count() < 1)
								<div class="alert alert-info">
									<h4><i class="fas fa-fw fa-info"></i> Não há chamados.</h4>
								</div>
							@else
								<table class="table table-sm table-hover table-striped dataTable dtr-inline">
									<thead class="text-cyan">
									<tr>
										<th>Nome</th>
										<th>Username</th>
										<th>E-mail</th>
										<th>Função</th>
										<th>Permissões</th>
										<th class="td-actions text-right">Ações</th>
									</tr>
									</thead>
									<tbody>
									@foreach($users as $u)
										<tr>
											<td>{{ $u->name }}</td>
											<td>{{ $u->username }}</td>
											<td>{{ $u->email }}</td>
											<td>{{ implode(', ', $u->chamados()->get()->pluck('number')->toArray()) }}</td>
											<td>
												@foreach($u->roles as $role)
												<span class="badge badge-info">
													{!! ucfirst($role->name) !!}
												</span>
												@endforeach
											</td>
											<td class="td-actions text-right">
												{{-- <a href="{{ route('dashboard.users.show', $u->username) }}" class="btn btn-sm text-info"><i class="fas fa-eye"></i></a> --}}
												<a href="{{ route('dashboard.users.edit', $u->username) }}" class="btn btn-sm text-success"><i class="fas fa-edit"></i></a>
												<a href="{{ route('dashboard.users.destroy', $u->id) }}" class="btn btn-sm text-danger @if($u->hasRole('admin'))disabled @endif"><i class="fas fa-trash"></i></a>
											</td>
										</tr>
									@endforeach
									</tbody>
								</table>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop
