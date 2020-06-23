@extends('adminlte::page')

@section('title', 'Chamados')

@section('content_header')
<div class="row mb-2">
	<div class="col-sm-6">
		<h1 class="m-0 text-dark">Chamados</h1>
	</div><!-- /.col -->
	<div class="col-sm-6">
		<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item"><a href="{{ route('dashboard.') }}" title="Dashboard" class="text-cyan"><i
						class="fad fa-home"></i></a></li>
			<li class="breadcrumb-item active">Chamados</li>
		</ol>
	</div><!-- /.col -->
</div>
@stop

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card card-outline card-navy">
			<div class="card-header border-0">
				<div class="d-flex justify-content-between">
					<h3 class="card-title">Gerenciamento de chamados e diárias</h3>
					<a href="{{ route('dashboard.chamados.create') }}" class="btn btn-flat btn-xs btn-success"><i
							class="fad fa-plus"></i>
						Novo chamado</a>
				</div>

			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<div class="row">
					<div class="col-lg-10 col-md-6 col-sm-4">
						<p class="text-left">
							<span class="badge badge-pill badge-warning">
								<i class="fad fa-circle "></i> Total chamados:@if($chamados->count() < 1) 0 @else {{ $chamados->count() }} @endif
							</span>
							
							<span class="badge badge-pill badge-info">
								<i class="fad fa-circle"></i> Abertos	{{ $chamados->where('status', 0)->count() }}
							</span>

							<span class="badge badge-pill badge-success">
								<i class="fad fa-circle"></i> Concluídos: {{ $chamados->where('status', 1)->count() }}
							</span>

							<span class="badge badge-pill badge-danger">
								<i class="fad fa-circle"></i> Pendentes: {{ $chamados->where('status', 2)->count() }}
							</span>
						</p>
					</div>

				</div>
				<div class="row">
					<div class="col-sm-12">
						@if($chamados->count() < 1) <div class="alert alert-danger alert-with-icon">
							<h4><i class="fad fa-info"></i> Não há chamados.</h4>
					</div>
					@else
					<table id="table" class="table table-sm table-hover table-striped dataTable dtr-inline" role="grid"
						width="100%">
						<thead class="text-cyan">
							<tr>
								<th scope="row">Nº</th>
								<th>Tipo</th>
								<th>Técnico</th>
								<th>Analista</th>
								<th>Agendamento</th>
								<th>Status</th>
								<th>UF</th>
								<th>Cliente</th>
								<th class="text-right">Ações</th>
							</tr>
						</thead>
						<tbody>
							@can('gerente')
							@foreach ($chamados as $chamado)
							<tr class="@if($chamado->produtiva == 'on') bg-secondary @endif">
								<th scope="row">{{ $chamado->number }}</th>
								<td>{{ $chamado->present()->tipo }}</td>
								<td>{{ $chamado->tecnico->name }}</td>
								<td>{{ $chamado->analista->name }}</td>
								<td>{{ $chamado->present()->date_br }}</td>
								<td>{!! $chamado->present()->statusFormated !!}</td>
								<td>{{ $chamado->state->title }}</td>
								<td>{{ $chamado->subClient->name }}</td>
								<td class="td-actions text-right">
									<a href="{{ route('dashboard.chamados.show', $chamado->number) }}" id="getChamadom" class="btn btn-sm text-info" data-toggle="modalm"
										data-target="#viewChamadom" title="Ver detalhes"
										data-url="{{ route('dashboard.chamados.show', $chamado->number) }}">
										<i class="fad fa-eye"></i>
									</a>

									<a href="{{ route('dashboard.chamados.edit', $chamado->number) }}"
										class="btn btn-sm text-warning" title="Editar">
										<i class="fad fa-edit"></i>
									</a>

									<a class="btn btn-sm delete-confirm text-red" title="Excluir" data-toggle="modal"
										data-target="#delete"
										onclick="confirmDelete('{{ route('dashboard.chamados.destroy', $chamado->id) }}')">
										<i class="fad fa-trash"></i>
									</a>
								</td>
							</tr>
							@endforeach
							@elsecan('analista')
							@foreach ($chamados->where('user_id', Auth()->user()->id) as $chamado)
							<tr>
								<th scope="row">{{ $chamado->number }}</th>
								<td>{{ $chamado->present()->tipo }}</td>
								<td>{{ $chamado->tecnico->name }}</td>
								<td>{{ $chamado->analista->name }}</td>
								<td>{{ $chamado->present()->date_br }}</td>
								<td>{!! $chamado->present()->statusFormated !!}</td>
								<td>{{ $chamado->state->title }}</td>
								<td>{{ $chamado->subClient->name }}</td>
								<td class="td-actions text-right">
									<a href="{{ route('dashboard.chamados.show', $chamado->number) }}" class="btn btn-sm text-info" title="Ver detalhes">
										<i class="fad fa-eye"></i>
									</a>

									<a href="{{ route('dashboard.chamados.edit', $chamado->number) }}" rel="tooltip"
										class="btn btn-sm text-warning" data-original-title="Editar" title="Editar">
										<i class="fad fa-edit"></i>
									</a>
								</td>
							</tr>
							@endforeach
							@endcan
						</tbody>
					</table>
					@endif
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
@stop

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
