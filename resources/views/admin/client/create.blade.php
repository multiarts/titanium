@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Clientes</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.') }}" title="Painel de controle" class="text-cyan">
                    <i class="fad fa-home"></i>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.clientes.index') }}">Clientes</a></li>
            <li class="breadcrumb-item active">Novo</li>
        </ol>
    </div><!-- /.col -->
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-outline card-navy">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Novo Cliente</h3>
                </div>

            </div>
            <!-- /.card-header -->
            <form action="{{ route('dashboard.clientes.store') }}" method="POST" class="form">
                @csrf
                <div class="card-body">
                    @include('admin.client.partial.form')
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-flat btn-sm btn-info"><i class="fad fa-save"></i> Cadastrar</button>
                    <a href="{{ route('dashboard.clientes.index') }}" class="btn btn-flat btn-sm btn-danger"><i class="fad fa-times"></i> Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
$('#states_id').on('change',function(e){
                            
    $('#cite_id').find('option').remove().end();
    var cat_id = $('#states_id option:selected').attr('value');

    var info=$.get('/get-cidades/' + cat_id);
    info.done(function(data){
        $.each(data,function(index,subcatObj){
            $('#cite_id').append('<option value="'+subcatObj.id+'">'+	subcatObj.title+'</option>').prop('disabled', false);
        });
    });
    info.fail(function(){
        alert('ok');
    });
});
</script>
@stop