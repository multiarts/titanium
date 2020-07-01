@extends('adminlte::page')

@section('title', 'Painel de controle')



@section('content_header')
<div class="row mb-2">
	<div class="col-sm-6">
		<h4 class="m-0 text-dark">Bem vindo, {{ Auth()->user()->name ?? '' }}</h4>
	</div><!-- /.col -->
@stop

	@section('content')
	
	<div class="row">
		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-infos bg-gradient-info elevation-3-info">
				<div class="inner">
					<h3>{{ $tecnicos->count() }}</h3>
					<p>Técnicos</p>
				</div>
				<div class="icon">
					<i class="fad fa-cogs"></i>
				</div>
				<a href="{{ route('dashboard.tecnicos.index') }}" class="small-box-footer">Ver todos <i
						class="fad fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-infos bg-gradient-secondary elevation-3">
				<div class="inner">
					<h3>{{ $users->count() }}</h3>
					<p>Analistas</p>
				</div>
				<div class="icon">
					<i class="fad fa-users"></i>
				</div>
				<a href="{{ route('dashboard.users.index') }}" class="small-box-footer">Ver todos <i
						class="fad fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-infos bg-gradient-olive elevation-3-olive">
				<div class="inner">
					<h3>{{ $chamados->where('type', 1)->count() }}</h3>
					<p>Chamados</p>
				</div>
				<div class="icon">
					<i class="fad fa-comments"></i>
				</div>
				<a href="{{ route('dashboard.chamados.index') }}" class="small-box-footer">Ver todos <i
						class="fad fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-infos bg-gradient-purple elevation-3-purple">
				<div class="inner">
					<h3>{{ $chamados->where('type', 0)->count() }}</h3>
					<p>Diárias</p>
				</div>
				<div class="icon">
					<i class="fad fa-comments"></i>
				</div>
				<a href="{{ route('dashboard.chamados.index') }}" class="small-box-footer">Ver todos <i
						class="fad fa-arrow-circle-right"></i></a>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8">
			<div class="card elevation-2">
				<div class="card-header border-transparent">
					<h3 class="card-title">Útimos chamados e Diárias</h3>

					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse">
							<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<div class="table-responsive">
						<table id="tables" class="table table-sm table-hover table-striped dtr-inline" role="grid">
							<thead>
								<tr>
									<th width="10%">Nº</th>
									<th>Tipo</th>
									<th>Cliente</th>
									<th>Estado</th>
									<th>Cidade</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($chamados as $c)
								<tr>
									<th>
										<a class="text-{{ $c->present()->statusAlert }}"
											href="{{ route('dashboard.chamados.show', $c->number) }}">{{ $c->number }}</a>
									</th>
									<td>{{ $c->present()->tipo }}</td>
									<td>{{ $c->subClient->name }}</td>
									<td>{{ $c->state->letter }}</td>
									<td>{{ $c->city->title }}</td>
									<td>{!! $c->present()->statusFormated !!}</td>
									<td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				<div class="card-footer clearfix" style="display: block;">
					<a href="{{ route('dashboard.chamados.create') }}" class="btn btn-sm btn-info float-left">Cadastrar
						novo chamado</a>
					<a href="{{ route('dashboard.chamados.index') }}" class="btn btn-sm btn-secondary float-right">Ver
						todos</a>
				</div>
			</div>

			<div class="card elevation-2">
				<div class="card-header border-transparent">
					<h3 class="card-title">Analistas</h3>

					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse">
							<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<div class="table-responsive">
						<table id="tables" class="table table-sm table-hover table-striped dtr-inline" role="grid">
							<thead>
								<tr>
									<th>Foto</th>
									<th>Username</th>
									<th>Nome</th>
									<th>Chamados</th>
									<th>Permissão</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($users as $u)
								<tr>
									<td>
										@if($u->image)
										<img src="{{ asset("uploads/{$u->image}") }}" alt="{{ $u->name }}"
											class="elevation-1 img-size-50">
										@else
										<img src="{{ asset('images/image_default.png') }}" alt="Sem foto"
											class="elevation-1 img-size-50">
										@endif
									</td>
									<th>
										<a href="{{ route('dashboard.users.edit', $u->username) }}">{{ $u->username }}</a>
									</th>
									<td>{{ $u->name }}</td>
									<td>{{ implode(', ', $u->chamados()->get()->pluck('number')->toArray()) }}</td>
									<td>
										@foreach($u->roles as $role)
										<span class="badge badge-info">
											{!! ucfirst($role->name) !!}
										</span>
										@endforeach
									</td>
									
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				<div class="card-footer clearfix" style="display: block;">
					<a href="{{ route('dashboard.users.create') }}" class="btn btn-sm btn-info float-left">Cadastrar
						novo analista</a>
					<a href="{{ route('dashboard.users.index') }}" class="btn btn-sm btn-secondary float-right">Ver
						todos</a>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="card elevation-2">
				<div class="card-header">
					<h3 class="card-title">Técnicos recentes</h3>

					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse">
							<i class="fal fa-minus"></i>
						</button>
					</div>
				</div>
				<!-- /.card-header -->
				<div class="card-body p-0">
					<ul class="products-list product-list-in-card pl-2 pr-2">
						@foreach ($tecnicos->take(6) as $t)
						<li class="item">
							<div class="product-img">
								@if($t->image)
								<img src="{{ asset("uploads/{$t->image}") }}" alt="{{ $t->name }}"
									class="elevation-1 img-size-50">
								@else
								<img src="{{ asset('images/image_default.png') }}" alt="Sem foto"
									class="elevation-1 img-size-50">
								@endif
							</div>
							<div class="product-info">
								<a href="javascript:void(0)" class="product-title">{{ $t->name }}
									@if ($t->active == 'on')
									<span class="badge badge-success float-right">Habilitado</span>
									@else
									<span class="badge badge-danger float-right">Desabilitado</span>
									@endif
								</a>
								<span class="product-description">
									{{ $t->email }}
								</span>
							</div>
						</li>
						@endforeach
					</ul>
				</div>
				<!-- /.card-body -->
				<div class="card-footer text-center">
					<a href="{{ route('dashboard.tecnicos.index') }}" class="uppercase btn btn-secondary btn-block">Ver
						todos</a>
				</div>
				<!-- /.card-footer -->
			</div>
		</div>
	</div>

	@stop

	@section('css')
	{{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
	@include('partials.css')
	@stop

	{{--@section('plugins.Datatables', true)--}}
	@section('js')
	@include('partials.js')
	@stop