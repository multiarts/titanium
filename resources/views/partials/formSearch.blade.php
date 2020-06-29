<label class="mr-md-2" for="from_date">De:</label>
<input type="date" class="form-control mb-2 mr-md-2" name="from_date" id="from_date">

<label for="to_date" class="mb-2 mr-md-2">Até:</label>
<div class="input-group mb-2 mr-sm-2">
    <input type="date" class="form-control" name="to_date" id="to_date">
</div>


<button type="button" name="filter" id="filter" class="btn btn-info btn-sm mr-2"><i class="fad fa-filter"></i>
    Filtrar</button>
<a href="{{ route('dashboard.chamados.index') }}" class="btn btn-success btn-sm"><i class="fad fa-eraser"></i>
    Limpar</a>