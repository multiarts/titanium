@extends('adminlte::page')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-titanium">

                        <h4 class="card-title">
                            <div class="row">
                               <div class="col-md-10">
                                {{ $tecnico->name }} ::
                                {{ $chamados->count() }}

                            </div>
                            <div class="col-md-2">
                                <span class="text-right">
                                    @if ($tecnico->active)
                                    <div class="badge badge-success">Ativo</div>
                                    @else
                                    <div class="badge badge-danger">Desativado</div>
                                    @endif
                                </span>
                            </div> 
                            </div>
                            
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @if ($chamados->count() < 1)
                                <h5 class="text-center text-danger">Não há chamados atribuídos para este Técnico.</h5>
                                <p class="text-center"><a href="{{ route('dashboard.tecnicos.index') }}" class="btn btn-info"><i class="fas fa-times"></i> Voltar</a></p>
                            @else
                            <table class="table table-striped table-hover table-sm">
                                <thead class="text-primary">
                                    <tr>
                                        {{-- <th>#</th> --}}
                                        <th>Nº chamado</th>
                                        <th>Analista</th>
                                        <th>Data chamado</th>
                                        <th>Valor</th>
                                        <th class="text-right">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($chamados as $tec)
                                    <tr>
                                        <td>
                                            {{ $tec->num_chamado }}
                                        </td>
                                        <td>
                                            {{ $tec->analista->name }}
                                        </td>
                                        <td>
                                            {{ $tec->data }}
                                        </td>
                                        <td>
                                            {{ $tec->valor }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>                                
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection