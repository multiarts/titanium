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

    @foreach ($chamado as $key => $c)
        <p>
            {{ $key }} :: {{ $c->number }} :: {{ $c->city->title }}
        </p>    
    @endforeach

@stop