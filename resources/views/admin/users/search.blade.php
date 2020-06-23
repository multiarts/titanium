@extends('adminlte::page')

@section('title', 'Novo analista')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Novo analista</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.') }}"><i class="fad fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">Analistas</a></li>
            <li class="breadcrumb-item active">Novo analista</li>
        </ol>
    </div><!-- /.col -->
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="col-md-4">
            <form action="/search" method="GET">
                @csrf
                <div class="input-group mb-3">
                    <input type="search" name="search" class="form-control" placeholder="Procurar...">
                    <span class="input-group-append">
                        <button type="submit" class="btn btn-info"><i class="fad fa-search"></i></button>
                    </span>
                </div>
            </form>
        </div> {{-- form-search --}}
        <table class="table table-bordered table-hover table-sm mydataTable" id="table">
            <thead>
                <tr>
                    <th>Nº Chamado</th>
                    <th>Cliente</th>
                    <th>Tipo</th>
                    <th>Agendado para</th>
                </tr>
            </thead>
            <tbody>
                @foreach($chamados as $c)
                <tr>
                    <td>{{ $c->number }}</td>
                    <td>{{ $c->subClient->name }}</td>
                    <td>{{ $c->present()->tipo }}</td>
                    <td>{{ date('m/d/Y', strtotime($c->dt_scheduling)) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

@section('css')
@include('partials.css')
@endsection
@section('js')
@include('partials.js')
@endsection