<div class="form-row">
    <div class="col-md-3 @error('name') text-danger @enderror">
        <label for="name">Nome do subcliente</label>
        <input type="text" id="name" name="name"
            class="form-control form-control-sm @error('name') is-invalid @enderror" value="{{ $subclient->name ?? old('name') }}">
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-3 @error('client_id') text-danger @enderror">
        <label for="client_id">Subcliente de:</label>
        <select name="client_id" id="client_id" class="form-control form-control-sm">
            <option value="{{ $subclient->client_id ?? '0' }}" selected disabled>{{ $subclient->client->name ?? 'Selecione o Cliente' }}</option>
            @foreach ($client as  $c)
                <option value="{{ $c->id }}">{{ $c->name }}</option>
            @endforeach
        </select>
        @error('client_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-3 @error('email') text-danger @enderror">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email"
            class="form-control form-control-sm @error('email') is-invalid @enderror" value="{{ $subclient->email ?? old('email') }}">
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-3 @error('site') text-danger @enderror">
        <label for="site">Site</label>
        <input type="url" id="site" name="site"
            class="form-control form-control-sm @error('site') is-invalid @enderror" value="{{ $subclient->site ?? old('site') }}">
        @error('site')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-row">
    
    <div class="col-md-6 @error('address') text-danger @enderror">
        <label for="address">Endereço</label>
        <input type="text" id="address" name="address"
            class="form-control form-control-sm @error('address') is-invalid @enderror"
            value="{{ $subclient->address ?? old('address') }}">
        @error('address')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-4 @error('bairro') text-danger @enderror">
        <label for="bairro">Bairro</label>
        <input type="text" id="bairro" name="bairro"
            class="form-control form-control-sm @error('bairro') is-invalid @enderror"
            value="{{ $subclient->bairro ?? old('bairro') }}">
        @error('bairro')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-2 @error('zipcode') text-danger @enderror">
        <label for="zipcode">CEP</label>
        <input type="text" id="zipcode" name="zipcode"
            class="form-control form-control-sm @error('zipcode') is-invalid @enderror" value="{{ $subclient->zipcode ?? old('zipcode') }}">
        @error('zipcode')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-row">
    <div class="col-md-2 @error('phone') text-danger @enderror">
        <label for="phone">Telefone</label>
        <input type="tel" id="phone" name="phone"
            class="form-control form-control-sm @error('phone') is-invalid @enderror" value="{{ $subclient->phone ?? old('phone') }}">
        @error('phone')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-2 @error('phone2') text-danger @enderror">
        <label for="phone2">Telefone 2</label>
        <input type="tel" id="phone2" name="phone2"
            class="form-control form-control-sm @error('phone2') is-invalid @enderror" value="{{ $subclient->phone2 ?? old('phone2') }}">
        @error('phone2')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-3 @error('cnpj') text-danger @enderror">
        <label for="cnpj">CNPJ</label>
        <input type="text" id="cnpj" name="cnpj"
            class="form-control form-control-sm @error('cnpj') is-invalid @enderror" value="{{ $subclient->cnpj ?? old('cnpj') }}">
        @error('cnpj')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-3 @error('ie') text-danger @enderror">
        <label for="ie">Inscrição Estadual</label>
        <input type="text" id="ie" name="ie"
            class="form-control form-control-sm @error('ie') is-invalid @enderror" value="{{ $subclient->ie ?? old('ie') }}">
        @error('ie')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-row">
    <div class="col-md-4 @error('state_id') text-danger @enderror">
        <label for="state_id">Estado</label>
        <select name="state_id" id="state_id" class="form-control form-control-sm">
            <option value="{{ $subclient->state_id ?? '0' }}" selected disabled>{{ $subclient->state->title ?? 'Selecione o estado' }}</option>
            @foreach ($states as  $s)
                <option value="{{ $s->id }}">{{ $s->title }}</option>
            @endforeach
        </select>
        @error('state_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-4 @error('cite_id') text-danger @enderror">
        <label for="cite_id">Cidade</label>
        <select name="cite_id" id="cite_id" class="form-control form-control-sm" disabled>
            <option value="{{ $subclient->cite_id ?? '0' }}" selected disabled>{{ $subclient->cite->title ?? 'Primeiro selecione o Estado' }}</option>
        </select>
        @error('cite_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    
</div>