@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
	<div class="row mb-2">
		<div class="col-sm-6">
			<h1 class="m-0 text-dark">Chamados</h1>
		</div><!-- /.col -->
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="{{ route('dashboard.') }}" title="Dashboard" class="text-cyan"><i
							class="fas fa-home"></i></a></li>
				<li class="breadcrumb-item active">Chamados</li>
			</ol>
		</div><!-- /.col -->
	</div>
@stop

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card animate__animated animate__fadeIn">
				<div class="card-header border-0">
					<div class="d-flex justify-content-between">
						<h3 class="card-title">Gerenciamento de chamados e diárias</h3>
						<a href="{{ route('dashboard.chamados.create') }}" class="btn btn-sm btn-success"><i
								class="fas fa-plus"></i>
							Novo</a>
					</div>

				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<div class="row">
						<div class="col-lg-10 col-md-6 col-sm-4">
							<p class="text-left">
							<span class="btn btn-sm btn-warning">
								Total chamados:
								@if($chamados->count() < 1) 0 @else {{ $chamados->count() }} @endif </span> <span
									class="btn btn-sm btn-info">Abertos:
									{{ $chamados->where('status', 0)->count() }}
							</span>
								<span class="btn btn-sm btn-success">Concluídos:
								{{ $chamados->where('status', 1)->count() }}</span>
								<span class="btn btn-sm btn-danger">Pendentes:
								{{ $chamados->where('status', 2)->count() }}</span>
							</p>
						</div>

					</div>
					<div class="row">
						<div class="col-sm-12">
							@if($chamados->count() < 1)
								<div class="alert alert-danger alert-with-icon">

									<h4><i class="fas fa-info"></i> Não há chamados.</h4>
								</div>
							@else
								<table id="example1" class="table table-responsive table-sm table-hover table-striped dataTable dtr-inline" role="grid"
											 aria-describedby="example1_info">
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
											<tr>
												<th scope="row">{{ $chamado->number }}</th>
												<td>{{ $chamado->present()->tipo }}</td>
												<td>{{ $chamado->tecnico->name }}</td>
												<td>{{ $chamado->analista->name }}</td>
												<td>{{ $chamado->present()->date_br }}</td>
												<td>{!! $chamado->present()->statusFormated !!}</td>
												<td>{{ $chamado->state->title }}</td>
												<td>{{ $chamado->sub_client->name }}</td>
												<td class="td-actions text-right">
													<a href="#" id="getChamado" rel="tooltip" class="btn btn-sm text-info" data-toggle="modal"
														 data-target="#viewChamado" data-original-title="Ver detalhes" title="Ver detalhes"
														 data-id="{{$chamado->number}}"
														 data-url="{{ route('dashboard.chamados.show', $chamado->number) }}">
														<i class="fas fa-eye"></i>
													</a>

													<a href="{{ route('dashboard.chamados.edit', $chamado->number) }}" rel="tooltip"
														 class="btn btn-sm text-warning" data-original-title="Editar" title="Editar">
														<i class="fas fa-edit"></i>
													</a>

													<form id="delete-form-{{ $chamado->id }}"
																action="{{ route('dashboard.chamados.destroy', $chamado->number) }}" method="POST"
																style="display: none;">
														@csrf
														{{ method_field('DELETE') }}
													</form>
													<a class="btn btn-sm delete-confirm text-red" title="Excluir"
														 onclick="confirmDelete('{{ $chamado->id }}')">
														<i class="fas fa-trash"></i>
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
												<td>{{ $chamado->sub_client->name }}</td>
												<td class="td-actions text-right">
													<a href="#" id="getChamado" rel="tooltip" class="btn btn-sm text-info" data-toggle="modal"
														 data-target="#viewChamado" data-original-title="Ver detalhes" title="Ver detalhes"
														 data-id="{{$chamado->number}}"
														 data-url="{{ route('dashboard.chamados.show', $chamado->number) }}">
														<i class="fas fa-eye"></i>
													</a>

													<a href="{{ route('dashboard.chamados.edit', $chamado->number) }}" rel="tooltip"
														 class="btn btn-sm text-warning" data-original-title="Editar" title="Editar">
														<i class="fas fa-edit"></i>
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
@stop

@section('load_js')
	<script>
		$('#example1').DataTable({
			// "paging": true,
			// ordering: true,
			info: false,
			// autoWidth: false,
			responsive: true,
			pageLength: 5,
			language: {
				url: "{{ asset('js/dataTables.pt_br.json') }}"
			}
		});

		function confirmDelete(item_id) {
			const swalWithBootstrapButtons = Swal.mixin({
				customClass: {
					confirmButton: 'btn btn-sm btn-success',
					cancelButton: 'btn btn-sm btn-danger'
				},
				buttonsStyling: true
			})
			swalWithBootstrapButtons.fire({
				title: 'Tem certeza?',
				icon: 'warning',
				text: "Se excluir este chamado não será possível recuperá-lo!",
				showCancelButton: true,
				confirmButtonText: 'Sim',
				cancelButtonText: 'Não',
				reverseButtons: true
			}).then((result) => {
				if (result.value) {
					$('#delete-form-' + item_id).submit();
				}
			})
		}

		$(document).on('click', '#getChamado', function (e) {
			e.preventDefault();
			let url = $(this).data('url');
			$('.message-modal').html('');
			$('#modal-loader').show();
			$.ajax({
				url: url,
				type: 'GET',
				dataType: 'html'
			})
				.done(function (data) {
					// console.log(data);
					$('.message-modal').html('');
					$('.message-modal').html(data); // load response
					$('#modal-loader').hide();      // hide ajax loader
				})
				.fail(function () {
					$('#dynamic-content').html('<i class="fas fa-sign"></i> Something went wrong, Please try again...');
					$('#modal-loader').hide();
				});
		});
	</script>

@stop
