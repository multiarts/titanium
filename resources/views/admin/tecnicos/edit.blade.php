@extends('adminlte::page')

@section('title', "Editando Técnico $tecnico->name")

@section('content_header')
<div class="row mb-2">
	<div class="col-sm-6">
		<h1 class="m-0 text-dark">Editar</h1>
	</div><!-- /.col -->
	<div class="col-sm-6">
		<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item"><a href="{{ route('dashboard.') }}"><i class="fad fa-home"></i></a></li>
			<li class="breadcrumb-item active">{{ $tecnico->name }}</li>
		</ol>
	</div><!-- /.col -->
</div>
@stop

@section('content')
<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card card-danger card-outline">
				<div class="card-header">
					<div class="d-flex justify-content-between">
						<h4 class="card-title">
							Editando {{ $tecnico->name }}
						</h4>
						<p class="card-category">
							Cadastrado em: {{ date('d/m/Y H:m', strtotime($tecnico->created_at)) }}
						</p>
					</div>
				</div>
				<form action="{{ route('dashboard.tecnicos.update', $tecnico->id) }}" method="POST"	enctype="multipart/form-data" role="form">
					@method('PATCH')
					@include('admin.tecnicos.template.form')
				</form>
			</div>
		</div>
	</div>
</div>

@endsection

@section('css')
@include('partials.css')
@endsection

@section('js')
@include('partials.js')
@endsection