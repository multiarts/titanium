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
			<div class="card-header border-0">
				<div class="d-flex justify-content-between">
					<h3 class="card-title">Gerenciamento de chamados e diárias</h3>
					<a href="{{ route('dashboard.chamados.create') }}"
						class="btn btn-flat btn-sm btn-success elevation-2"><i class="fad fa-plus"></i>
						Novo chamado</a>
				</div>

			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<div class="row">
					<div class="col-lg-10 col-md-6 col-sm-4">
						<p class="text-left">
							<span class="badge badge-pill badge-warning">
								<i class="fad fa-circle "></i> Total chamados:@if($chamados->count() < 1) 0 @else
									{{ $chamados->count() }} @endif </span> <span class="badge badge-pill badge-info">
									<i class="fad fa-circle"></i> Abertos {{ $chamados->where('status', 0)->count() }}
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
					<div class="col-md-12">
						@if($chamados->count() < 1) <div class="alert alert-danger alert-with-icon">
							<h4><i class="fad fa-info"></i> Não há chamados.</h4>
					</div>
				</div>
				@else

				<form class="form-inline mb-3" action="{{ route('dashboard.chamados.index') }}" id="formSearch">
					@csrf
					@include('partials.formSearch')
				</form>

				<table id="table" class="table table-sm table-hover table-striped  dtr-inline" role="grid" width="100%">
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
						<tr class="@if($chamado->produtiva == 'on') bg-danger @endif">
							<th scope="row">{{ $chamado->number }}</th>
							<td>{{ $chamado->present()->tipo }}</td>
							<td>{{ $chamado->tecnico->name }}</td>
							<td>{{ $chamado->analista->name }}</td>
							<td>{{ $chamado->present()->date_br }}</td>
							<td>{{ $chamado->end }}</td>
							<td>{!! $chamado->present()->statusFormated !!}</td>
							<td>{{ $chamado->state->letter }}</td>
							<td>{{ $chamado->subClient->name }}</td>
							<td>
								<a href="{{ route('dashboard.chamados.show', $chamado->number) }}" id="getChamadom"
									class="btn btn-sm text-info" data-toggle="modalm" data-target="#viewChamadom"
									title="Ver detalhes"
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
						<tr class="@if($chamado->produtiva == 'on') bg-danger @endif">
							<th scope="row">{{ $chamado->number }}</th>
							<td>{{ $chamado->present()->tipo }}</td>
							<td>{{ $chamado->tecnico->name }}</td>
							<td>{{ $chamado->analista->name }}</td>
							<td>{{ $chamado->present()->date_br }}</td>
							<td>{!! $chamado->present()->statusFormated !!}</td>
							<td>{{ $chamado->state->title }}</td>
							<td>{{ $chamado->subClient->name }}</td>
							<td class="td-actions text-right">
								<a href="{{ route('dashboard.chamados.show', $chamado->number) }}"
									class="btn btn-sm text-info" title="Ver detalhes">
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


				<div class="pull-right">
					<div class="btn-group">
						<button type="button" class="btn btn-success btn-filter" data-target="pagado">Pagado</button>
						<button type="button" class="btn btn-warning btn-filter" data-target="pendiente">Pendiente</button>
						<button type="button" class="btn btn-danger btn-filter" data-target="cancelado">Cancelado</button>
						<button type="button" class="btn btn-default btn-filter" data-target="all">Todos</button>
					</div>
				</div>
				<table class="table tableJ table-filter">
					<tbody>
						<tr data-status="pagado">
							<td>
								<div class="ckbox">
									<input type="checkbox" id="checkbox1">
									<label for="checkbox1"></label>
								</div>
							</td>
							<td>
								<a href="javascript:;" class="star">
									<i class="fad fa-star"></i>
								</a>
							</td>
							<td>
								<div class="media">
									<a href="#" class="pull-left">
										<img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
									</a>
									<div class="media-body">
										<span class="media-meta pull-right">Febrero 13, 2016</span>
										<h4 class="title">
											Lorem Impsum
											<span class="pull-right pagado">(Pagado)</span>
										</h4>
										<p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
									</div>
								</div>
							</td>
						</tr>
						<tr data-status="pendiente">
							<td>
								<div class="ckbox">
									<input type="checkbox" id="checkbox3">
									<label for="checkbox3"></label>
								</div>
							</td>
							<td>
								<a href="javascript:;" class="star">
									<i class="fad fa-star"></i>
								</a>
							</td>
							<td>
								<div class="media">
									<a href="#" class="pull-left">
										<img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
									</a>
									<div class="media-body">
										<span class="media-meta pull-right">Febrero 13, 2016</span>
										<h4 class="title">
											Lorem Impsum
											<span class="pull-right pendiente">(Pendiente)</span>
										</h4>
										<p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
									</div>
								</div>
							</td>
						</tr>
						<tr data-status="cancelado">
							<td>
								<div class="ckbox">
									<input type="checkbox" id="checkbox2">
									<label for="checkbox2"></label>
								</div>
							</td>
							<td>
								<a href="javascript:;" class="star">
									<i class="fad fa-star"></i>
								</a>
							</td>
							<td>
								<div class="media">
									<a href="#" class="pull-left">
										<img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
									</a>
									<div class="media-body">
										<span class="media-meta pull-right">Febrero 13, 2016</span>
										<h4 class="title">
											Lorem Impsum
											<span class="pull-right cancelado">(Cancelado)</span>
										</h4>
										<p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
									</div>
								</div>
							</td>
						</tr>
						<tr data-status="pagado" class="selected">
							<td>
								<div class="ckbox">
									<input type="checkbox" id="checkbox4" checked>
									<label for="checkbox4"></label>
								</div>
							</td>
							<td>
								<a href="javascript:;" class="star star-checked">
									<i class="fad fa-star"></i>
								</a>
							</td>
							<td>
								<div class="media">
									<a href="#" class="pull-left">
										<img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
									</a>
									<div class="media-body">
										<span class="media-meta pull-right">Febrero 13, 2016</span>
										<h4 class="title">
											Lorem Impsum
											<span class="pull-right pagado">(Pagado)</span>
										</h4>
										<p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
									</div>
								</div>
							</td>
						</tr>
						<tr data-status="pendiente">
							<td>
								<div class="ckbox">
									<input type="checkbox" id="checkbox5">
									<label for="checkbox5"></label>
								</div>
							</td>
							<td>
								<a href="javascript:;" class="star">
									<i class="fad fa-star"></i>
								</a>
							</td>
							<td>
								<div class="media">
									<a href="#" class="pull-left">
										<img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
									</a>
									<div class="media-body">
										<span class="media-meta pull-right">Febrero 13, 2016</span>
										<h4 class="title">
											Lorem Impsum
											<span class="pull-right pendiente">(Pendiente)</span>
										</h4>
										<p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
									</div>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
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
<style>
	/*	--------------------------------------------------
	:: Table Filter
	-------------------------------------------------- */
.panel {
	border: 1px solid #ddd;
	background-color: #fcfcfc;
}
.panel .btn-group {
	margin: 15px 0 30px;
}
.panel .btn-group .btn {
	transition: background-color .3s ease;
}
.table-filter {
	background-color: #fff;
	border-bottom: 1px solid #eee;
}
.table-filter tbody tr:hover {
	cursor: pointer;
	background-color: #eee;
}
.table-filter tbody tr td {
	padding: 10px;
	vertical-align: middle;
	border-top-color: #eee;
}
.table-filter tbody tr.selected td {
	background-color: #eee;
}
.table-filter tr td:first-child {
	width: 38px;
}
.table-filter tr td:nth-child(2) {
	width: 35px;
}
/*.ckbox {
	position: relative;
}
.ckbox input[type="checkbox"] {
	opacity: 0;
}
.ckbox label {
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
}
.ckbox label:before {
	content: '';
	top: 1px;
	left: 0;
	width: 18px;
	height: 18px;
	display: block;
	position: absolute;
	border-radius: 2px;
	border: 1px solid #bbb;
	background-color: #fff;
}
 .ckbox input[type="checkbox"]:checked + label:before {
	border-color: #2BBCDE;
	background-color: #2BBCDE;
}
.ckbox input[type="checkbox"]:checked + label:after {
	top: 3px;
	left: 3.5px;
	content: '\e013';
	color: #fff;
	font-size: 11px;
	font-family: 'Font Awesome 5 Duotone';
	position: absolute;
} */
.table-filter .star {
	color: #ccc;
	text-align: center;
	display: block;
}
.table-filter .star.star-checked {
	color: #F0AD4E;
}
.table-filter .star:hover {
	color: #ccc;
}
.table-filter .star.star-checked:hover {
	color: #F0AD4E;
}
.table-filter .media-photo {
	width: 35px;
}
.table-filter .media-body {
    display: block;
    /* Had to use this style to force the div to expand (wasn't necessary with my bootstrap version 3.3.6) */
}
.table-filter .media-meta {
	font-size: 11px;
	color: #999;
}
.table-filter .media .title {
	color: #2BBCDE;
	font-size: 14px;
	font-weight: bold;
	line-height: normal;
	margin: 0;
}
.table-filter .media .title span {
	font-size: .8em;
	margin-right: 20px;
}
.table-filter .media .title span.pagado {
	color: #5cb85c;
}
.table-filter .media .title span.pendiente {
	color: #f0ad4e;
}
.table-filter .media .title span.cancelado {
	color: #d9534f;
}
.table-filter .media .summary {
	font-size: 14px;
}
</style>
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
			$('.tableJ tr').css('display', 'none');
			$('.tableJ tr[data-status="' + $target + '"]').fadeIn('slow');
		} else {
			$('.tableJ tr').css('display', 'none').fadeIn('slow');
		}
		});

});
</script>
@stop