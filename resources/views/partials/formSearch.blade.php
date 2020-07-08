<label class="mr-md-2" for="from_date">De:</label>
<input type="date" class="form-control form-control-sm mr-md-2" name="from_date" id="from_date" value="{{ $fromDate }}">

<div class="form-group mr-sm-2a">
    <label for="to_date" class="mr-md-2">Até:</label>
    <input type="date" class="form-control form-control-sm" name="to_date" id="to_date" value="{{ $toDate }}">
</div>

<div class="btn-group btn-group-toggle ml-3 mr-3 shadow" data-toggle="buttons">

    <label class="btn btn-xs btn-flat btn-warning @if($status == 1) active @endif">
        <input type="radio" name="status" id="option1" value="1" autocomplete="off" @if($status == 1) checked @endif> Aberto 
    </label>

    <label class="btn btn-xs btn-flat btn-secondary @if($status == 2) active @endif">
        <input type="radio" name="status" id="option2" value="2" autocomplete="off" @if($status == 2) checked @endif> Em andamento
    </label>

    <label class="btn btn-xs btn-flat btn-danger @if($status == 3) active @endif">
        <input type="radio" name="status" id="option3" value="3" autocomplete="off" @if($status == 3) checked @endif> Fechado
    </label>

    <label class="btn btn-xs btn-flat btn-success @if($status == 4) active @endif">
        <input type="radio" name="status" id="option4" value="4" autocomplete="off" @if($status == 4) checked @endif> Finalizado
    </label>

    <label class="btn btn-xs btn-flat btn-primary @if($status == '0') active @endif">
        <input type="radio" name="status" id="option5" value="0" autocomplete="off" @if($status == '0') checked @endif> Todos
    </label>
</div>

<button type="button" name="filter" id="filter" class="btn btn-info btn-sm mr-2 mb-2">
    <i class="fad fa-filter"></i> Filtrar
</button>
<a href="{{ route('dashboard.chamados.index') }}" class="btn btn-success btn-sm mb-2">
    <i class="fad fa-eraser"></i> Limpar
</a>