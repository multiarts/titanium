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
			<li class="breadcrumb-item active">Analistas</li>
		</ol>
	</div><!-- /.col -->
</div>
@stop

@section('content')
<div class="row">
	<div class="col-sm-12">
		@if (session('success'))
		<div class="alert alert-success">
			{{ session('success') }}
		</div>
		@endif
		<div class="card card-navy card-outline">
			<div class="card-header border-0">
				<div class="d-flex justify-content-between">
					<h3 class="card-title">Listagem de analistas</h3>
					<a href="{{ route('dashboard.users.create') }}" class="btn btn-flat btn-sm btn-success">
						<i class="fad fa-plus"></i> Cadastrar novo
					</a>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-sm-12">
						@if ($users->count() < 1) <div class="alert alert-info">
							<h4><i class="fad fa-fw fa-info"></i> Não há chamados.</h4>
					</div>
					@else
					<table id="table" class="table table-sm table-hover table-striped dataTable dtr-inline" role="grid"
						wiidth="100%">
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
									text-info"><i class="fad fa-eye"></i></a> --}}
									<a href="{{ route('dashboard.users.edit', $u->username) }}"
										class="btn btn-sm text-success"><i class="fad fa-edit"></i></a>
									<a href="" class="btn btn-sm text-danger @if($u->hasRole('admin'))disabled @endif"
										title="Excluir" data-toggle="modal" data-target="#delete"
										onclick="confirmDelete('{{ route('dashboard.users.destroy', $u->username) }}')">
										<i class="fad fa-trash"></i>
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


<div class="modal" id="delete" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
		<div class="modal-content deleteContent">
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
					<p class="text-center text-warning"><i class="fad fa-3x fa-exclamation-triangle"></i></p>
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
@endsection

@section('css')
@include('partials.css')
@stop

@section('js')
@include('partials.js')
<script>
	function confirmDelete(item_id) {
		$('.deleteContent').addClass('bounceIn').removeClass('flipOutX');
		$('#deleteForm').attr('action', item_id);
	}
</script>
@stop