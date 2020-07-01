<label class="mr-md-2" for="from_date">De:</label>
<input type="date" class="form-control form-control-sm mr-md-2" name="from_date" id="from_date">

<div class="form-group mr-sm-2a">
    <label for="to_date" class="mr-md-2">Até:</label>
    <input type="date" class="form-control form-control-sm" name="to_date" id="to_date">
</div>


<button type="button" name="filter" id="filter" class="btn btn-info btn-sm mr-2 mb-2"><i class="fad fa-filter"></i>
    Filtrar</button>
<a href="{{ route('dashboard.chamados.index') }}" class="btn btn-success btn-sm mb-2"><i class="fad fa-eraser"></i>
    Limpar</a>