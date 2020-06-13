@extends('adminlte::page')

@section('load_css')
@include('partials.css')
@stop

@section('title', 'Técnicos')

@section('content_header')
<div class="row mb-2">
	<div class="col-sm-6">
		<h1 class="m-0 text-dark">Técnicos</h1>
	</div><!-- /.col -->
	<div class="col-sm-6">
		<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item"><a href="{{ route('dashboard.') }}" title="Dashboard" class="text-cyan"><i
						class="fas fa-home"></i></a></li>
			<li class="breadcrumb-item active">Técnicos</li>
		</ol>
	</div><!-- /.col -->
</div>
@stop

@section('content')
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div class="d-flex justify-content-between">
							<h4 class="card-title">Gerenciamento de Técnicos</h4>
							<div>
								Total cadastrados: {{ $tecnicos->count() }}
								<div class="badge badge-success">
									Habilitados: {{ $tecnicos->where('active', 'on')->count() }}
								</div>

								<div class="badge badge-danger">
									Desabilitados: {{ $tecnicos->where('active', 'off')->count() }}
								</div>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-lg-12 col-md-6 col-sm-4">
								<p class="text-right">
									<a href="{{ route('dashboard.tecnicos.create') }}" title="Cadastre novo técnico"
										class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Novo</a></p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								@if($tecnicos->count() < 1) <div class="alert alert-danger alert-with-icon">
									<h4><i class="fas fa-info"></i> Não há técnicos cadastrados.</h4>
							</div>
							@else
							<div class="xoxota">
								<div class="col-md-6"></div>
							</div>
							<table id="table" class="table table-responsive-sm table-hover table-sm dataTable">
								<thead class="text-cyan">
									<tr>
										<th>Foto</th>
										<th>Nome</th>
										<th>E-mail</th>
										<th>Telefone</th>
										<th>CPF</th>
										<th>Status</th>
										<th>Estado</th>
										<th class="text-right">Ações</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($tecnicos as $tec)
									<tr>
										<td>
											@if($tec->image)
											<img src="{{ asset("storage/{$tec->image}") }}" alt="{{ $tec->name }}"
												width="40px" class="img-circle elevation-1">
											@else
											<img src="{{ asset('images/image_default.png') }}" alt="Sem foto"
												width="40px" class="img-circle elevation-1">
											@endif
										</td>
										<td>{{ $tec->name }}</td>
										<td>{{ $tec->email }}</td>
										<td>{{ $tec->telefone }}</td>
										<td>{{ $tec->cpf }}</td>
										<td>
											@if ($tec->active == 'on')
											<div class="badge badge-success">Habilitado</div>
											@else
											<div class="badge badge-danger">Desabilitado</div>
											@endif
										</td>
										{{-- <td>{{ $tec->estado()->get()->pluck('letter')->first() }}</td> --}}
										<td>
											{!! $tec->state->title ?? '<span class="text-danger">Finalize o
												regístro</span>' !!}
										</td>
										<td class="td-actions text-right">
											<a href="{{ route('dashboard.tecnicos.show', $tec->id) }}" id="getChamadzo"
												class="btn btn-sm text-info" data-toggle="modalz"
												data-target="#viewChamadzo" title="Ver detalhes"
												data-url="{{ route('dashboard.tecnicos.show', $tec->id) }}">
												<i class="fas fa-eye"></i>
											</a>

											<a rel="tooltip" class="btn text-success btn-sm"
												href="{{ route('dashboard.tecnicos.edit', $tec->id) }}" title="Editar">
												<i class="fas fa-edit"></i>
											</a>

											{{-- Admin only --}}
											@can('delete')
											<form id="delete-form-{{ $tec->id }}"
												action="{{ route('dashboard.tecnicos.destroy', $tec) }}" method="POST"
												style="display: none;">
												@csrf
												{{ method_field('DELETE') }}
											</form>
											<a class="btn btn-sm delete-confirm text-red" title="Excluir"
												data-toggle="modal" data-target="#delete"
												onclick="confirmDeleteA('{{ route('dashboard.tecnicos.destroy', $tec->id) }}')">
												<i class="fas fa-trash"></i>
											</a>
											@endcan
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
</div>
</div>

<div class="card">
	<div class="modal fade bd-example-modal-lg" id="viewChamado" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<!-- Modal content-->
				<div class="message-modal"></div>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="delete" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-danger">
				<h5 class="modal-title" id="chamadoModalLabel">Excluir chamado</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="deleteForm" method="POST">
				@method('DELETE')
				@csrf
				<div class="modal-body">
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
@section('load_js')
@include('partials.js')
<script>
	function confirmDeleteA(item_id) {
		$('.modal-content').addClass('bounceIn').removeClass('flipOutX');
		$('#deleteForm').attr('action', item_id);
    }
</script>
@stop