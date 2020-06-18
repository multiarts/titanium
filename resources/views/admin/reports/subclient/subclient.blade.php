@extends('adminlte::page')

@section('css')
@include('partials.css')
@stop

@section('title', 'Relatórios por cidade')

@section('content_header')
<div class="row mb-2">
	<div class="col-sm-6">
		<h1 class="m-0 text-dark">Sub-cliente</h1>
	</div><!-- /.col -->
	<div class="col-sm-6">
		<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item"><a href="{{ route('dashboard.report.subclient') }}" title="Chamados"
					class="text-cyan"><i class="fad fa-home"></i></a></li>
			<li class="breadcrumb-item active">Sub-cliente</li>
		</ol>
	</div><!-- /.col -->
</div>
@stop

@section('content')
<div class="row">
	@foreach ($subclient as $key => $c)
	@php
		$ch = $chamado->where('sub_client_id', $c->id);
	@endphp
        @if (!$ch->count())
			
		@else
		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-infos bg-gradient-danger elevation-3-danger">
				<div class="inner">
					<h4>{{ $c->name }}</h4>
					<p>Chamados: {{ $ch->count() }}</p>
				</div>
				<div class="icon">
					<i class="fad fa-user-friends"></i>
				</div>
				<a href="{{ route('dashboard.report.subclient.name', $c->id) }}" class="small-box-footer">Ver todos <i
						class="fad fa-arrow-circle-right"></i></a>
			</div>
		</div>
		@endif  
	@endforeach
</div>
@stop