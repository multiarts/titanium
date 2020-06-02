@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="row mb-2">
	<div class="col-sm-6">
		<h1 class="m-0 text-dark">Bem vindo {{ Auth()->user()->name ?? '' }}</h1>
	</div><!-- /.col -->
	<div class="col-sm-6">
		<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item active">Dashboard</li>
		</ol>
	</div><!-- /.col -->
</div>
@stop

@section('content')
<div class="row">
	<div class="col-lg-3 col-6">
		<!-- small box -->
		<div class="small-box bg-infos bg-gradient-info">
			<div class="inner">
				<h3>25</h3>

				<p>Técnicos</p>
			</div>
			<div class="icon">
				<i class="fas fa-users"></i>
			</div>
			<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box bg-orange">
			<span class="info-box-icon text-white"><i class="fas fa-users"></i></span>
			<div class="info-box-content text-white">
				<span class="info-box-text">Técnicos</span>
				<span class="info-box-number">41 <small>Total</small></span>
				<!-- The progress section is optional -->
				<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
				</div>
				<span class="progress-description">
					70% Increase in 30 Days
				</span>
			</div>
			<!-- /.info-box-content -->
		</div>
	</div>
	<div class="col-md-3 col-sm-6 col-xs-12">
		<!-- Apply any bg-* class to to the info-box to color it -->
		<div class="info-box bg-red">
			<span class="info-box-icon"><i class="fas fa-comments"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Likes</span>
				<span class="info-box-number">41,410</span>
				<!-- The progress section is optional -->
				<div class="progress">
					<div class="progress-bar" style="width: 70%"></div>
				</div>
				<span class="progress-description">
					70% Increase in 30 Days
				</span>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>
	<div class="col-md-3 col-sm-6 col-xs-12">
		<!-- Apply any bg-* class to to the info-box to color it -->
		<div class="info-box bg-blue">
			<span class="info-box-icon"><i class="fas fa-comments"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Likes</span>
				<span class="info-box-number">41,410</span>
				<!-- The progress section is optional -->
				<div class="progress">
					<div class="progress-bar" style="width: 70%"></div>
				</div>
				<span class="progress-description">
					70% Increase in 30 Days
				</span>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">DataTable with default features</h3>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<div class="row">
					<div class="col-sm-12">
						<table id="example1" class="table table-sm table-hover table-striped dataTable dtr-inline"
							role="grid" aria-describedby="example1_info">
							<thead>
								<tr>
									<th>Nº</th>
									<th>Tipo</th>
									<th>Cliente</th>
									<th>Estado</th>
									<th>Cidade</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><a href="">ABC123</a></td>
									<td>Chamado</td>
									<td>Cliente A</td>
									<td>RS</td>
									<td>Canos</td>
									<td>
										@can('edit')
										<span class="badge bg-success">Concluído</span>
										@endcan
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@stop

@section('css')
{{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('plugins.Datatables', true)
@section('js')
<script>
	$('#example1').DataTable({
	// "paging": true,
	"ordering": true,
	info: false,
	"autoWidth": false,
	"responsive": true,
	language: {
		url: "{{ asset('js/dataTables.pt_br.json') }}"
	}
  });
</script>

@stop
