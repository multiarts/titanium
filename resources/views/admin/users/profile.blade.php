@extends('adminlte::page')

@section('css')
    @include('partials.css')
    <style>
        .tabs-animated .nav-link {
            position: relative;
            padding: 1rem;
            margin: 0 .75rem 0 0;
            color: #495057
        }

        .tabs-animated .nav-link::before {
            transform: scale(0);
            opacity: 1;
            width: 100%;
            left: 0;
            bottom: -2px;
            content: "";
            position: absolute;
            display: block;
            border-radius: .35rem;
            background: #c84ada;
            transition: all .2s;
            height: 4px
        }

        .tabs-animated .nav-link.active,
        .tabs-animated .nav-link:hover {
            color: #da624a
        }

        .tabs-animated .nav-link.active::before,
        .tabs-animated .nav-link:hover::before {
            transform: scale(1)
        }

        .tabs-animated-shadow .nav-link {
            padding: .5rem .75rem;
            margin-bottom: .75rem
        }

        .tabs-animated-shadow .nav-link span {
            position: relative;
            z-index: 5;
            display: inline-block;
            width: 100%
        }

        .tabs-animated-shadow .nav-link::before {
            height: 100%;
            top: 0;
            z-index: 4;
            bottom: auto;
            box-shadow: 0 16px 26px -10px rgba(193, 42, 192, 0.56), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(218, 98, 74, 0.2);
            border-radius: 100%;
            opacity: .5
        }

        .tabs-animated-shadow .nav-link.active,
        .tabs-animated-shadow .nav-link:hover {
            color: #fff
        }

        .tabs-animated-shadow .nav-link.active::before,
        .tabs-animated-shadow .nav-link:hover::before {
            border-radius: .35rem;
            opacity: 1
        }

        .tabs-animated-shadow .nav-item:last-child .nav-link {
            margin-right: 0
        }

        .tabs-animated-shadow.tabs-shadow-bordered {
            border-bottom: #dee2e6 solid 1px
        }

        .tabs-animated-shadow.tabs-shadow-bordered .nav-link {
            margin-bottom: 0
        }

    </style>
@stop

@section('title', 'Meu perfil')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Perfil</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.chamados.index') }}" title="Chamados"
                        class="text-cyan"><i class="fad fa-home"></i></a></li>
                <li class="breadcrumb-item active">{{ $user->name }}</li>
            </ol>
        </div><!-- /.col -->
        @if ($errors->any())
            <div class="callout callout-danger elevation-2 col-6">
                <h6><i class="icon fad fa-exclamation-triangle"></i> Atenção</h6>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-9">
        {{-- <ul class="tabs-animated-shadow tabs-animated nav nav-justified tabs-shadow-bordered p-3">
			<li class="nav-item">
				<a role="tab" class="nav-link" data-toggle="tab" href="#tab-messages-header" aria-selected="false">
					<span>Messages</span>
				</a>
			</li>
			<li class="nav-item">
				<a role="tab" class="nav-link active" data-toggle="tab" href="#tab-events-header" aria-selected="true">
					<span>Events</span>
				</a>
			</li>
			<li class="nav-item">
				<a role="tab" class="nav-link" data-toggle="tab" href="#tab-errors-header" aria-selected="false">
					<span>System</span>
				</a>
			</li>
		</ul> --}}
            <form method="POST" action="{{ route('dashboard.perfil.update', $user->id) }}" enctype="multipart/form-data"
                role="form">
                @csrf
                @method('PATCH')

                <div class="card card-outline @if (session('success')) card-success @else card-navy @endif">
                    {{-- <div class="card-header card-header-titanium">
							<h4 class="card-title">Perfil de usuário :: {{ $user->name }}</h4>
			</div> --}}

                    <div class="card-body">

                        {{-- <input type="hidden" name="name" value="{{ $user->name }}"> --}}

                        <div class="form-row">
                            <div class="col-md-4">
                                <label for="name">Nome</label>
                                <div class="form-group bmd-form-group is-filled">
                                    <input class="form-control form-control-sm  @error('name') is-invalid @enderror"
                                        name="name" id="name" type="text" placeholder="name" value="{{ $user->name }}"
                                        required aria-required="true">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="username">Usuário de login</label>
                                <div class="form-group">
                                    <input class="form-control form-control-sm  @error('username') is-invalid @enderror"
                                        name="username" id="username" type="text" placeholder="Username"
                                        value="{{ $user->username }}" required aria-required="true">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="cpf">CPF</label>
                                <div class="form-group">
                                    <input class="form-control form-control-sm  @error('cpf') is-invalid @enderror"
                                        name="cpf" id="cpf" type="text" placeholder="CPF" value="{{ $user->cpf }}"
                                        required aria-required="true">
                                </div>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="col-sm-4">
                                <label for="email">Email</label>
                                <div class="form-group bmd-form-group is-filled">
                                    <input class="form-control form-control-sm  @error('email') is-invalid @enderror"
                                        name="email" type="email" placeholder="email" value="{{ $user->email }}">
                                    @error('email')
                                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <label for="password">Senha</label>
                                <div class="form-group bmd-form-group is-filled">
                                    <input class="form-control form-control-sm  @error('password') is-invalid @enderror"
                                        name="password" type="password" placeholder="Senha">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <label for="rg">RG</label>
                                <div class="form-group bmd-form-group is-filled">
                                    <input class="form-control form-control-sm  @error('rg') is-invalid @enderror" name="rg"
                                        type="text" placeholder="RG" value="{{ $user->rg }}">
                                </div>
                            </div>

                        </div>

                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="customFile" for="image">Imagem</label>

                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image">
                                    <label class="custom-file-label" for="image"></label>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-info"><i class="fad fa-save"></i> Atualizar</button>

                    </div> {{-- card-body --}}

            </form>
        </div>

    </div>
    <div class="col-md-3">
        <div class="card card-navy card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    @if ($user->image)
                        <img src="{{ asset("uploads/{$user->image}") }}" alt="{{ $user->name }}"
                            class="profile-user-img img-fluid img-circle">
                    @else
                        <img src="{{ asset('images/image_default.png') }}" alt="{{ $user->name }}"
                            class="profile-user-img img-fluid img-circle">
                    @endif
                </div>
                <h3 class="profile-username text-center">{{ $user->name }}</h3>
                <p class="text-muted text-center">
                    @foreach ($user->roles as $role)
                        <span class="badge badge-info">
                            {!! ucfirst($role->name) !!}
                        </span>
                    @endforeach
                </p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Chamados</b> <a class="float-right">{{ $chamados->count() }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Abertos</b> <a class="float-right">{{ $chamados->where('status', 0)->count() }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Concluídos</b> <a class="float-right">{{ $chamados->where('status', 1)->count() }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Pendentes</b> <a class="float-right">{{ $chamados->where('status', 2)->count() }}</a>
                    </li>
                </ul>
                <a href="#" class="btn btn-danger btn-block"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                        class="fad fa-fw fa-power-off"></i> <b>Desconectar</b></a>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('partials.js')
@stop
