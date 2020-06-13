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
		<div class="card card-navy card-outline">
			<div class="card-header border-0">
				<div class="d-flex justify-content-between">
					<h3 class="card-title">Listagem de analistas</h3>
					<a href="" class="btn btn-sm btn-success">
						<i class="fas fa-plus"></i>Novo
					</a>
				</div>
			</div>
			<div class="card-body table-responsive">
				<div class="row">
					<div class="col-sm-12">
						@if ($users->count() < 1) <div class="alert alert-info">
							<h4><i class="fas fa-fw fa-info"></i> Não há chamados.</h4>
					</div>
					@else
					<table id="table" class="table table-sm table-hover table-striped dataTable" width="100%">
						<thead class="text-cyan">
							<tr>
								<th>Nome</th>
								<th>Username</th>
								<th>E-mail</th>
								<th>Chamados</th>
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
									{{-- <a href="{{ route('dashboard.users.show', $u->username) }}" class="btn btn-sm
									text-info"><i class="fas fa-eye"></i></a> --}}
									<a href="{{ route('dashboard.users.edit', $u->username) }}"
										class="btn btn-sm text-success"><i class="fas fa-edit"></i></a>
									<a href="" class="btn btn-sm text-danger @if($u->hasRole('admin'))disabled @endif"
										title="Excluir" data-toggle="modal" data-target="#delete"
										onclick="confirmDeleteA('{{ route('dashboard.users.destroy', $u->id) }}')">
										<i class="fas fa-trash"></i>
									</a>
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


<div class="modal" id="delete" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header bg-danger">
				<h5 class="modal-title" id="chamadoModalLabel">Excluir analista</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="deleteForm" method="POST">
				@method('DELETE')
				@csrf
				<div class="modal-body">
					<p class="text-center text-warning"><i class="fas fa-3x fa-exclamation-triangle"></i></p>
					<h3 class="text-center text-danger">Tem certeza?</h3>
					<p class="text-center">Se excluir não será possível recuperar.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-sm btn-secondary col-sm-4 no">Não</button>
					<button type="submit" class="btn btn-sm btn-success btn-submit col-sm-4">Sim, excluir</button>
				</div>
			</form>
		</div>
	</div>
</div>
@stop

@section('load_css')
	@include('partials.css')
@stop

@section('js')
	@include('partials.js')
@stop
