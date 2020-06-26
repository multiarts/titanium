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
        {{-- <div class="col-md-4">
            <form action="/search" method="GET">
                @csrf
                <div class="input-group mb-3">
                    <input type="search" name="search" class="form-control" placeholder="Procurar...">
                    <span class="input-group-append">
                        <button type="submit" class="btn btn-info"><i class="fad fa-search"></i></button>
                    </span>
                </div>
            </form>
        </div> {{-- form-search --}
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
        </table> --}}

        <div class="col-md-5">Sample Data - Total Records - <b><span id="total_records"></span></b></div>
        <div class="col-md-5">
            <div class="input-group input-daterange">
                <input type="date" name="from_date" id="from_date" class="form-control" />
                <div class="input-group-addon">to</div>
                <input type="date" name="to_date" id="to_date" class="form-control" />
            </div>
        </div>
        <div class="col-md-2">
            <button type="button" name="filter" id="filter" class="btn btn-info btn-sm">Filter</button>
            <button type="button" name="refresh" id="refresh" class="btn btn-warning btn-sm">Refresh</button>
        </div>


        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="tablea">
                    <thead>
                        <tr>
                            <th width="5%">Nº Chamado</th>
                            <th width="50%">Endereço</th>
                            <th width="15%">Publish Date</th>
                            <th width="15%">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
                {{ csrf_field() }}
            </div>
        </div>
    </div>
</div>

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
@endsection
@section('js')
@include('partials.js')

<script>
$(document).ready(function () {
    function confirmDelete(item_id) {
        $('.deleteContent').addClass('bounceIn').removeClass('flipOutX');
        $('#deleteForm').attr('action', item_id);
    }

    let date = new Date();
    let d = date.getDay();
    let m = date.getMonth() + 1;
    let y = date.getFullYear();
    let dateComplete = d+'/'+m+'/'+y;

    /*  $('.input-daterange').datepicker({
    todayBtn: 'linked',
    format: 'yyyy-mm-dd',
    autoclose: true
    }); */

    var _token = $('input[name="_token"]').val();

    fetch_data();

    function fetch_data(from_date = '', to_date = '') {
        $.ajax({
            url: "{{ route('dashboard.search.users') }}",
            method: "POST",
            data: { from_date: from_date, to_date: to_date, _token: _token },
            dataType: "json",
            success: function (data) {
                var output = '';
                $('#total_records').text(data.length);
                for (var count = 0; count < data.length; count++) {
                    let number = data[count].number;
                    output += '<tr>';
                    output += '<td>' + number + '</td>';
                    output += '<td>' + data[count].address + '</td>';
                    output += '<td>' + data[count].start + '</td>';
                    output += '<td>';
                    output += '<a href="'+data[count].number+'" class="btn btn-sm delete-confirm text-red" title="Excluir" data-toggle="modal" data-target="#delete" onclick="confirmDelete({{ route("dashboard.chamados.destroy","'+number+'") }})"><i class="fad fa-trash"></i></a>';
                    output += '</td></tr>';
                }
                $('tbody').html(output);
            }
        })
    }

    $('#filter').click(function () {
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        if (from_date != '' && to_date != '') {
            fetch_data(from_date, to_date);
        }
        else {
            alert('Both Date is required');
        }
    });

    $('#refresh').click(function () {
        $('#from_date').val('');
        $('#to_date').val('');
        fetch_data();
    });
});    
</script>
@endsection