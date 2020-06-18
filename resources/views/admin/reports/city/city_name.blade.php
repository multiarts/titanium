@extends('adminlte::page')

@section('css')
@include('partials.css')
@stop

@section('title', 'Relatórios por cidade')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">{{ $city->title }}</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.chamados.index') }}" title="Chamados"
                    class="text-cyan"><i class="fad fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.report.city') }}">Cidade</a></li>
            <li class="breadcrumb-item active">{{ $city->title }}</li>
        </ol>
    </div><!-- /.col -->
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <table id="table" class="table">
            <thead class="d-print-none">
                <tr>
                    <th>Ordenar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($chamado as $item)
                @php
                $a = array($item->v_deslocamento, $item->v_km, $item->v_titanium, $item->v_atendimento);
                $subTotal = array_sum($a);
                @endphp
                <tr>
                    <td>
                        <div class="card card-outline card-secondary" id="div-{{ $item->number }}">
                            <div class="card-header">
                                <h3 class="card-title">{{ $item->present()->tipo }}: {{ $item->number }} <b>Técnico:</b>
                                    {{ $item->tecnico->name }}</h3>
                                <div class="card-tools">
                                    <button class="btn btn-info btn-sm btn-flat d-print-none"
                                        id="btn-{{ $item->number }}" onclick='printtag("div-{{ $item->number }}");'>
                                        <i class="fad fa-print"></i> Imprimir
                                    </button>

                                    <button type="button" class="btn btn-tool d-print-none" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="col-md-4">
                                    Data do chamado: {{ $item->created_at }} <br>
                                    R$ Atendimento: {{ $item->v_atendimento }} <br>
                                    R$ Titanium: {{ $item->v_titanium }} <br>
                                    R$ deslocamento: {{ $item->v_deslocamento }} <br>
                                    R$ KM: {{ $item->v_km }}
                                </div>
                            </div>
                            <div class="card-footer">Total: R${{ $subTotal }}</div>
                        </div>
                    </td>
                </tr>


                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('css')

@include('partials.css')
@stop

@section('js')
@include('partials.js')
<script>
    function printtag(tagid) {
            var hashid = "#"+ tagid;
            var tagname =  $(hashid).prop("tagName").toLowerCase() ;
            var attributes = ""; 
            var attrs = document.getElementById(tagid).attributes;
              $.each(attrs,function(i,elem){
                attributes +=  " "+  elem.name+" ='"+elem.value+"' " ;
              })
            var divToPrint= $(hashid).html() ;
            var head = "<html><head>"+ $("head").html() + "</head>" ;
            var allcontent = head + "<body onload='window.print()' >"+ "<" + tagname + attributes + ">" +  divToPrint + "</" + tagname + ">" +  "</body></html>"  ;
            var newWin=window.open('','Print-Window');
            newWin.document.open();
            newWin.document.write(allcontent);
            newWin.document.close();
           setTimeout(function(){newWin.close();},10);
        }
</script>
@stop