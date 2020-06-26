<div class="form-row">
    <div class="col-md-4 mb-3 @error('name') text-danger @enderror">
        <label for="name">Nome do cliente</label>
        <input type="text" id="name" name="name"
            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-6 mb-3 @error('address') text-danger @enderror">
        <label for="address">Endereço do cliente</label>
        <input type="text" id="address" name="address"
            class="form-control @error('address') is-invalid @enderror"
            value="{{ old('address') }}">
        @error('address')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-2 mb-3 @error('phone') text-danger @enderror">
        <label for="phone">Telefone</label>
        <input type="tel" id="phone" name="phone"
            class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
        @error('phone')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="form-row">
    <div class="col-md-4 mb-3 @error('states_id') text-danger @enderror">
        <label for="states_id">Estado</label>
        <select name="states_id" id="states_id" class="form-control">
            <option value="0" selected disabled>Selecione o estado</option>
            @foreach ($states as  $s)
                <option value="{{ $s->id }}">{{ $s->title }}</option>
            @endforeach
        </select>
        @error('states_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-4 mb-3 @error('cities_id') text-danger @enderror">
        <label for="cite_id">Cidade</label>
        <select name="cities_id" id="cite_id" class="form-control" disabled>
            <option value="0" selected disabled>Selecione a cidade</option>
        </select>
        @error('cities_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-2 mb-3 @error('zipcode') text-danger @enderror">
        <label for="zipcode">CEP</label>
        <input type="text" id="zipcode" name="zipcode"
            class="form-control @error('zipcode') is-invalid @enderror" value="{{ old('zipcode') }}">
        @error('zipcode')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>