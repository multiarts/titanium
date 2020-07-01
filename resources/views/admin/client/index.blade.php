@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Clientes</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.') }}" title="Painel" class="text-cyan"><i
                        class="fad fa-home"></i></a></li>
            <li class="breadcrumb-item active">Clientes</li>
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
                    <h3 class="card-title">Gerenciamento de Clientes</h3>
                    <a href="{{ route('dashboard.clientes.create') }}"
                        class="btn btn-flat btn-sm btn-success elevation-2"><i class="fad fa-plus"></i>
                        Novo cliente</a>
                </div>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        @if ($clients->count() < 1)
                        <h5><i class="fad fa-info"></i> Não há clientes.</h5>
                        @else
                        <table id="table" class="table table-sm table-hover table-striped dataTable dtr-inline"
                            role="grid">
                            <thead class="text-cyan">
                                <tr>
                                    <th>Cliente</th>
                                    <th>Telefone</th>
                                    <th>Endereço</th>
                                    <th>Estado</th>
                                    <th>Cidade</th>
                                    <th class="text-right">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $c)
                                    <tr>
                                        <td>{{ $c->name }}</td>
                                        <td>{{ $c->phone }}</td>
                                        <td>{{ $c->address }}</td>
                                        <td>{{ $c->state->title }}</td>
                                        <td>{{ $c->cite->title }}</td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('dashboard.clientes.show', $c->id) }}" id="getChamadom" class="btn btn-sm text-info" data-toggle="modalm"
                                                data-target="#viewChamadom" title="Ver detalhes"
                                                data-url="{{ route('dashboard.clientes.show', $c->id) }}">
                                                <i class="fad fa-eye"></i>
                                            </a>
        
                                            <a href="{{ route('dashboard.clientes.edit', $c->id) }}"
                                                class="btn btn-sm text-warning" title="Editar">
                                                <i class="fad fa-edit"></i>
                                            </a>
        
                                            <a class="btn btn-sm delete-confirm text-red" title="Excluir" data-toggle="modal"
                                                data-target="#delete"
                                                onclick="confirmDelete('{{ route('dashboard.clientes.destroy', $c->id) }}')">
                                                <i class="fad fa-trash"></i>
                                            </a>
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

{{-- Form-delete --}}
<div class="modal" id="delete" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content deleteContent">
			<div class="modal-header bg-danger">
				<h5 class="modal-title" id="chamadoModalLabel">Excluir chamado</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="deleteForm" method="POST">
				@method('DELETE')
				@csrf
				<div class="modal-body">
					<h3 class="text-center text-danger">Tem certeza?</h3>
					<p class="text-center">Se excluir não será possível recuperar.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-sm btn-secondary col-sm-4 no">Não</button>
					<button type="submit" class="btn btn-sm btn-success btn-submit col-sm-4">Sim, excluir</button>
				</div>
			</form>
		</div>
	</div>
</div>
@stop

@section('css')
@include('partials.css')
@stop

@section('js')
 @include('partials.js')
 <script>
	function confirmDelete(item_id) {
		$('.deleteContent').addClass('bounceIn').removeClass('flipOutX');
		$('#deleteForm').attr('action', item_id);
    }
</script>
@stop