@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="row mb-2">
	<div class="col-sm-6">
		<h1 class="m-0 text-dark">Analistas</h1>
	</div><!-- /.col -->
	<div class="col-sm-6">
		<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active">Analistas</li>
		</ol>
	</div><!-- /.col -->
</div>
@stop

@section('content')
<p>Bem vindo {{ Auth()->user()->name ?? '' }}.</p>
@stop