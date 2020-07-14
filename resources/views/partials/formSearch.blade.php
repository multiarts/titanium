<form class="form-inline mb-3" action="{{ route('dashboard.chamados.index') }}" id="formSearch" method="GET" role="form">
<label class="mr-md-2" for="from_date">De:</label>
<input type="date" class="form-control form-control-sm mr-md-2" name="date[from_date]" id="from_date" value="{{ isset($fromDate) ? $fromDate : '' }}">

<div class="form-group mr-sm-2a">
    <label for="date[to_date]" class="mr-md-2">Até:</label>
    <input type="date" class="form-control form-control-sm" name="date[to_date]" id="date[to_date]" value="{{ isset($toDate) ? $toDate : '' }}">
</div>

<div class="form-group">
    <select name="type" id="type" class="form-control form-control-sm">
        <option value="" selected disabled>Selecione o tipo</option>
        <option value="1" @if($type == 1) selected @endif">Diária</option>
        <option value="2" @if($type == 2) selected @endif">Chamado</option>
        <option value="3" @if($type == 3) selected @endif">Cotação</option>
    </select>
</div>

<div class="btn-group btn-group-toggle ml-3 mr-3 shadow" data-toggle="buttons">

    <label class="btn btn-xs btn-warning @if($status == 1) active @endif">
        <input type="radio" name="status" id="option1" value="1" autocomplete="off" @if($status == 1) checked @endif> Aberto 
    </label>

    <label class="btn btn-xs btn-secondary @if($status == 2) active @endif">
        <input type="radio" name="status" id="option2" value="2" autocomplete="off" @if($status == 2) checked @endif> Em andamento
    </label>

    <label class="btn btn-xs btn-danger @if($status == 3) active @endif">
        <input type="radio" name="status" id="option3" value="3" autocomplete="off" @if($status == 3) checked @endif> Fechado
    </label>

    <label class="btn btn-xs btn-success @if($status == 4) active @endif">
        <input type="radio" name="status" id="option4" value="4" autocomplete="off" @if($status == 4) checked @endif> Finalizado
    </label>
</div>

<button type="button" name="filter" id="filter" class="btn btn-info btn-sm mr-2 mb-2">
    <i class="fad fa-filter"></i> Filtrar
</button>
<a href="{{ route('dashboard.chamados.index') }}" class="btn btn-success btn-sm mb-2">
    <i class="fad fa-eraser"></i> Limpar
</a>