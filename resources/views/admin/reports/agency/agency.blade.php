@extends('adminlte::page')

@section('css')
@include('partials.css')
@stop

@section('title', 'Relatórios por cidade')

@section('content_header')
<div class="row mb-2">
	<div class="col-sm-6">
		<h1 class="m-0 text-dark">Agência</h1>
	</div><!-- /.col -->
	<div class="col-sm-6">
		<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item"><a href="{{ route('dashboard.chamados.index') }}" title="Chamados"
					class="text-cyan"><i class="fad fa-home"></i></a></li>
			<li class="breadcrumb-item active">Agênncia</li>
		</ol>
	</div><!-- /.col -->
</div>
@stop

@section('content')
<div class="row">
	@foreach ($agency as $key => $c)
	@php
		$ch = $chamado->where('agency_id', $c->id);
	@endphp
        @if (!$ch->count())
			
		@else
		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-infos bg-gradient-info elevation-3-info">
				<div class="inner">
					<h4>{{ $c->name }}</h4>
					<p>Chamados: {{ $ch->count() }}</p>
				</div>
				<div class="icon">
					<i class="fad fa-comment-dollar"></i>
				</div>
				<a href="{{ route('dashboard.report.agency.name', $c->id) }}" class="small-box-footer">Ver todos <i
						class="fad fa-arrow-circle-right"></i></a>
			</div>
		</div>
		@endif  
	@endforeach
</div>
@stop