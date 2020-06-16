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
    <div class="col-sm-12">
        <form action="{{ route('dashboard.users.store') }}" method="POST">
            @csrf
            @method('post')
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Novo analista</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group @error('name') text-danger @enderror">
                                <label for="name">Nome</label>
                                <input type="text" id="name" name="name"
                                    class="form-control form-control-sm @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @error('username') text-danger @enderror">
                                <label for="username">Username</label>
                                <input type="text" id="username" name="username"
                                    class="form-control form-control-sm @error('username') is-invalid @enderror"
                                    value="{{ old('username') }}">
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group @error('email') text-danger @enderror">
                                <label for="email">E-mail</label>
                                <input type="email" id="email" name="email"
                                    class="form-control form-control-sm @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @error('password') text-danger @enderror">
                                <label for="password">Senha</label>
                                <input type="password" id="password" name="password"
                                    class="form-control form-control-sm @error('password') is-invalid @enderror"
                                    value="{{ old('password') }}">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group @error('roles') text-danger @enderror">
                            <label class="control-label">Permissões</label>
                            <div class="col-md-12">
                                @foreach ($roles as $role)
                                <div class="form-check form-check-inline icheck-olive">
                                    <input type="checkbox" id="{{ $role->name }}" name="roles[]" value="{{ $role->id }}">
                                    <label for="{{ $role->name }}">{{ ucfirst($role->name) }}</label>
                                </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer clearfix">
                <button type="submit" class="btn btn-flat btn-success">
                    <i class="fad fa-save"></i> Salvar
                </button>
                <a href="{{ route('dashboard.users.index') }}" class="btn btn-flat btn-danger">
                    <i class="fad fa-times"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop