@extends('adminlte::page')

@section('css')
@include('partials.css')
@stop

@section('title', 'Relatórios por cidade')

@section('content_header')
<div class="row mb-2">
	<div class="col-sm-6">
		<h1 class="m-0 text-dark">Cidades</h1>
	</div><!-- /.col -->
	<div class="col-sm-6">
		<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item"><a href="{{ route('dashboard.chamados.index') }}" title="Chamados"
					class="text-cyan"><i class="fad fa-home"></i></a></li>
			<li class="breadcrumb-item active">Cidades</li>
		</ol>
	</div><!-- /.col -->
</div>
@stop

@section('content')
<div class="row">

	<div class="col-md-12">
		<div class="col-md-4">
			<form action="cidade" method="GET">
				@csrf
				<div class="input-group mb-3">
					<input type="search" name="search" class="form-control" placeholder="Procurar...">
					<span class="input-group-append">
						<button type="submit" class="btn btn-info"><i class="fad fa-search"></i></button>
					</span>
				</div>
			</form>
			<form class="form-inline mb-3" action="{{ route('dashboard.report.city') }}" id="formSearch" method="GET">
				@include('admin.reports.city.template.formSearch')
			</form>
		</div>
	</div>
	
	@foreach ($city as $key => $c)
	@php
		$ch = $chamado->where('cite_id', $c->id);
	@endphp
        @if (!$ch->count())
			
		@else
		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-infos bg-gradient-info elevation-3-info">
				<div class="inner">
					<h4>{{ $c->title }}</h4>
					<p>Chamados: {{ $ch->count() }}</p>
				</div>
				<div class="icon">
					<i class="fad fa-map-marker-check"></i>
				</div>
				<a href="{{ route('dashboard.report.city.name', $c->id) }}" class="small-box-footer">Ver todos <i
						class="fad fa-arrow-circle-right"></i></a>
			</div>
		</div>
		@endif  
	@endforeach
</div>
@stop