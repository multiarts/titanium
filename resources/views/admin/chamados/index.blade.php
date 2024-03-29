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
	<div class="col-md-12">
		<div class="card card-outline card-navy">

			<div class="card-header">
				<div class="d-flex justify-content-between">
					<h3 class="card-title">Gerenciamento de chamados e diárias</h3>
					<div class="card-tools">
						<a href="{{ route('dashboard.chamados.create') }}"
							class="btn btn-flat btn-sm btn-success elevation-2"><i class="fad fa-plus"></i>
							Novo chamado</a>
					</div>
				</div>
			</div>
			<!-- /.card-header -->

			<div class="card-body">

				<form class="form-inline mb-3" action="{{ route('dashboard.chamados.index') }}" id="formSearch" method="GET" role="form">
					@include('partials.formSearch')
				</form>

				<table id="table" class="table table-sm table-hover table-striped table-filter dtr-inline" role="grid" width="100%">
					<thead class="text-cyan">
						<tr>
							<th scope="row">Nº</th>
							<th>Tipo</th>
							<th>Técnico</th>
							<th>Analista</th>
							<th>Agendamento</th>
							<th>Dt. concluído</th>
							<th>Status</th>
							<th>Estado</th>
							<th>Cliente</th>
							<th>Ações</th>
						</tr>
					</thead>
					<tbody>
						@can('gerente')
						@foreach ($chamados as $chamado)
						<tr class="@if($chamado->improdutiva == 'on') bg-danger @endif" data-status="{{ $chamado->status }}">
							<th scope="row">{{ $chamado->number }}</th>
							<td>{{ $chamado->present()->tipo }}</td>
							<td>{!! Str::limit($chamado->tecnico->name, 15) !!}</td>
							<td>{{ $chamado->analista->name }}</td>
							<td id="fini">{{ $chamado->present()->date_br }}</td>
							<td id="ffin">{{ $chamado->end }}</td>
							<td>{!! $chamado->present()->statusFormated !!}</td>
							<td>{{ $chamado->state->letter }}</td>
							<td>{{ Str::limit($chamado->subClient->name, 10) }}</td>
							<td>
								<a href="{{ route('dashboard.chamados.show', $chamado->number) }}" id="getChamadom"
									class="btn btn-sm text-info" data-toggle="modalm" data-target="#viewChamadom" title="Ver detalhes"
									data-url="{{ route('dashboard.chamados.show', $chamado->number) }}">
									<i class="fad fa-eye"></i>
								</a>
				
								<a href="{{ route('dashboard.chamados.edit', $chamado->number) }}" class="btn btn-sm text-warning"
									title="Editar">
									<i class="fad fa-edit"></i>
								</a>
				
								<a class="btn btn-sm delete-confirm text-red" title="Excluir" data-toggle="modal" data-target="#delete"
									onclick="confirmDelete('{{ route('dashboard.chamados.destroy', $chamado->id) }}')">
									<i class="fad fa-trash"></i>
								</a>
							</td>
						</tr>
						@endforeach
						@elsecan('analista')
						@foreach ($chamados->where('user_id', Auth()->user()->id) as $chamado)
						<tr class="@if($chamado->improdutiva == 'on') bg-danger @endif" data-status="{{ $chamado->status }}">
							<th scope="row">{{ $chamado->number }}</th>
							<td>{{ $chamado->present()->tipo }}</td>
							<td>{!! Str::limit($chamado->tecnico->name, 5, '...') !!}</td>
							<td>{{ $chamado->analista->name }}</td>
							<td>{{ $chamado->present()->date_br }}</td>
							<td>{!! $chamado->present()->statusFormated !!}</td>
							<td>{{ $chamado->state->title }}</td>
							<td>{{ $chamado->subClient->name }}</td>
							<td class="td-actions text-right">
								<a href="{{ route('dashboard.chamados.show', $chamado->number) }}" class="btn btn-sm text-info"
									title="Ver detalhes">
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

			</div> <!-- /.card-body -->
		</div> <!-- /.card -->
	</div> <!-- ./col-12 -->
</div> <!-- ./row -->


<div class="modal fade bd-example-modal-lg" id="viewChamado" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<!-- Modal content-->
			<div class="message-modal"></div>
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
					<button type="submit" class="btn btn-sm btn-success btn-submit col-sm-4">Sim,
						excluir</button>
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
	$(document).ready(function () {

		$('.star').on('click', function () {
			$(this).toggleClass('star-checked');
		});

		$('.ckbox label').on('click', function () {
			$(this).parents('tr').toggleClass('selected');
		});

		$('.btn-filter').on('click', function () {
			var $target = $(this).data('target');
			if ($target != 'all') {
				$('.table tbody tr').css('display', 'none');
				$('.table tbody tr[data-status="' + $target + '"]').fadeIn('slow');
			} else {
			$('.table tbody tr').css('display', 'none').fadeIn('slow');
		}
	});
});
</script>
@stop