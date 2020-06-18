@extends('adminlte::page')

@section('title', 'Técnicos')

@section('content_header')
<div class="row mb-2">
	<div class="col-sm-6">
		<h1 class="m-0 text-dark">Técnicos</h1>
	</div><!-- /.col -->
	<div class="col-sm-6">
		<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item"><a href="{{ route('dashboard.') }}" title="Painel"><i
						class="fad fa-home"></i></a></li>
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
										class="btn btn-flat btn-sm btn-success"><i class="fad fa-plus"></i> Novo</a></p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								@if($tecnicos->count() < 1) <div class="alert alert-danger alert-with-icon">
									<h4><i class="fad fa-info"></i> Não há técnicos cadastrados.</h4>
							</div>
							@else
							<div class="xoxota">
								<div class="col-md-6"></div>
							</div>
							<table id="table" class="table table-responsive-sm table-hover table-sm dataTable">
								<thead class="text-cyan">
									<tr>
										<th>Nome</th>
										<th>E-mail</th>
										<th>Telefone</th>
										<th>Status</th>
										<th>Estado</th>
										<th class="text-right">Ações</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($tecnicos as $tec)
									@php
										$totalCount = $chamados->where('tecnico_id', $tec->id)->count();
									@endphp
									<tr>
										<td>
											{{ $tec->name }}
											@if($totalCount >= 1)
												<span class="badge badge-info float-right">
													{{ $totalCount }}
												</span>
											@endif
										</td>
										<td>{{ $tec->email }}</td>
										<td>{{ $tec->telefone }}</td>
										<td>
											@if ($tec->active == 'on')
											<div class="badge badge-success">Habilitado</div>
											@else
											<div class="badge badge-danger">Desabilitado</div>
											@endif
										</td>
										{{-- <td>{{ $tec->estado()->get()->pluck('letter')->first() }}</td> --}}
										<td>
											{!! $tec->state->letter ?? '<span class="text-danger">Finalize o
												regístro</span>' !!}
										</td>
										<td class="td-actions text-right">
											@if($chamados->where('tecnico_id', $tec->id)->count() < 1)
											<a href="" class="btn btn-xs btn-info disabled"><i class="fad fa-eye"></i></a>
											@else
											<a href="{{ route('dashboard.tecnicos.show', $tec->id) }}" class="btn btn-xs btn-info" title="Ver detalhes">
												<i class="fad fa-eye"></i>
											</a>
											@endif

											<a rel="tooltip" class="btn btn-success btn-xs"
												href="{{ route('dashboard.tecnicos.edit', $tec->id) }}" title="Editar">
												<i class="fad fa-edit"></i>
											</a>

											{{-- Admin only --}}
											@can('delete')											
											<a class="btn btn-xs delete-confirm btn-danger text-white" title="Excluir"
												data-toggle="modal" data-target="#delete"
												onclick="confirmDeleteA('{{ route('dashboard.tecnicos.destroy', $tec->id) }}')">
												<i class="fad fa-trash"></i>
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
		<div class="modal-content deleteContent">
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

@section('css')
	@include('partials.css')
@stop
@section('js')
	@include('partials.js')
<script>
	function confirmDeleteA(item_id) {
		$('.deleteContent').addClass('bounceIn').removeClass('flipOutX');
		$('#deleteForm').attr('action', item_id);
    }
</script>
@stop
