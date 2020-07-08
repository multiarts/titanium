<select name="month" id="month" class="form-control formcontrol-sm">
    <option value="01" @if($month == '01') selected @endif>Janeiro</option>
    <option value="02" @if($month == '02') selected @endif>Fevereiro</option>
    <option value="03" @if($month == '03') selected @endif>Março</option>
    <option value="04" @if($month == '04') selected @endif>Abril</option>
    <option value="05" @if($month == '05') selected @endif>Maio</option>
    <option value="06" @if($month == '06') selected @endif>Junho</option>
    <option value="07" @if($month == '07') selected @endif>Julho</option>
    <option value="08" @if($month == '08') selected @endif>Agosto</option>
    <option value="09" @if($month == '09') selected @endif>Setembro</option>
    <option value="10" @if($month == '10') selected @endif>Outubro</option>
    <option value="11" @if($month == '11') selected @endif>Novembro</option>
    <option value="12" @if($month == '12') selected @endif>Dezembro</option>
</select>



<button type="submit" class="btn btn-info btn-sm mr-2 mb-2">
    <i class="fad fa-filter"></i> Filtrar
</button>
{{-- <a href="{{ route('dashboard.report.city.name', $city->id) }}" class="btn btn-success btn-sm mb-2">
    <i class="fad fa-eraser"></i> Limpar
</a> --}}