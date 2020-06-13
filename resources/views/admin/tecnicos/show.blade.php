@extends('adminlte::page')

@section('title', $tecnico->name )

@section('content')
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card card-outline card-navy">
					<div class="card-header">
						<div class="d-flex justify-content-between">
							<h4 class="card-title">								
								{{ $tecnico->name }} -
								{{ $chamados->count() }} chamados.
							</h4>
							@can('gerente')
							<a href="{{ url('dashboard/tecnicos/showPDF', $tecnico->id)}}" target="_blank"
								class="btn text-info" title="Imprimir"><i class="fas fa-fw fa-print"></i></a>
								@endcan
						</div>


					</div>
					<div class="card-body">
						<div class="table-responsive">
							@if ($chamados->count() < 1) <h5 class="text-center text-danger">Não há chamados atribuídos
								para este Técnico.</h5>
								<p class="text-center"><a href="{{ route('dashboard.tecnicos.index') }}"
										class="btn btn-info"><i class="fas fa-times"></i> Voltar</a></p>
								@else
								<table id="table" class="table table-striped table-hover table-sm" width="100%">
									<thead class="text-primary">
										<tr>
											{{-- <th>#</th> --}}
											<th>Nº chamado</th>
											<th>Analista</th>
											<th>Dt. agendamento</th>
											<th>Valor</th>
											<th>Status</th>
											@can('gerente')
											<th class="text-right">Ações</th>
											@endcan
										</tr>
									</thead>
									<tbody>
										@foreach ($chamados as $tec)
										<tr>
											<td>
												{{ $tec->number }}
											</td>
											<td>
												{{ $tec->analista->name }}
											</td>
											<td>
												{{ $tec->present()->date_br }}
											</td>
											<td>
												{{ $tec->present()->valorFormated }}
											</td>
											<td>
												{!! $tec->present()->statusFormated !!}
											</td>
											@can('gerente')
											<td>
												<a href="{{ url('dashboard/tecnicos/pdf', $tec->id)}}" target="_blank" class="btn text-info" title="Imprimir">
													<i class="fas fa-print"></i>
												</a>
											</td>
											@endcan
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
@endsection

@section('css')
	@include('partials.css')
@stop

@section('js')
	@include('partials.js')
@stop



{{-- https://www.facebook.com/izabele.pereira.186?hc_location=ufi --}}