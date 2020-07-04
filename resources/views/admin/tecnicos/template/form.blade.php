@csrf
<div class="card-body">
    <div class="form-row">
        <div class="col-md-2">
            <div class="form-group">
                <div class="custom-control custom-switch custom-switch-off-warning custom-switch-on-success">
                    <input type="checkbox" class="custom-control-input" id="active" name="active"
                        @if($tecnico->active == 'on') checked @endif>
                    <label class="custom-control-label" for="active">Habilitado</label>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="form-group @if($tecnico->active == 'on') invisible @endif">
                <label class="control-label" for="motivo">Motivo</label>
                <input type="text" class="form-control" id="motivo" name="motivo"
                    {{ isset($tecnico->motivo) ? $tecnico->motivo : ''}}>
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-6">
            <label for="name">Nome</label>
            <input id="name" type="text" class="form-control form-control-sm @error('name') is-invalid @enderror"
                name="name" value="{{ $tecnico->name ?? old('name') }}" required>

            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="email">E-mail</label>
            <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror"
                name="email" value="{{ $tecnico->email ?? old('email') }}" required>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

    </div>

    <div class="form-row">
        <div class="col-md-2">
            <label for="telefone">Telefone</label>
            <input id="telefone" type="phone"
                class="form-control form-control-sm @error('telefone') is-invalid @enderror" name="telefone"
                value="{{ $tecnico->telefone ?? old('telefone') }}" required>

            @error('telefone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="col-md-2">
            <label for="telefone1">Celular</label>
            <input id="telefone1" type="phone"
                class="form-control form-control-sm @error('telefone1') is-invalid @enderror" name="telefone1"
                value="{{ $tecnico->telefone1 ?? old('telefone1') }}" required>

            @error('telefone1')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="col-md-3">
            <label for="rg">RG</label>
            <input id="rg" type="text" class="form-control form-control-sm @error('rg') is-invalid @enderror" name="rg"
                value="{{ $tecnico->rg ?? old('rg') }}">

            @error('rg')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="col-md-2">
            <label for="cpf">CPF</label>
            <input id="cpf" type="text" class="form-control form-control-sm @error('cpf') is-invalid @enderror"
                name="cpf" value="{{ $tecnico->cpf ?? old('cpf') }}" required>

            @error('cpf')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="col-md-2">
            <label for="cep">CEP</label>
            <input id="cep" type="text" class="form-control form-control-sm @error('cep') is-invalid @enderror"
                name="cep" value="{{ $tecnico->cep ?? old('cep') }}">

            @error('cep')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-6">
            <label for="address">Endereço</label>
            <input id="address" type="text" class="form-control form-control-sm @error('address') is-invalid @enderror"
                name="address" value="{{ $tecnico->address ?? old('address') }}" required>

            @error('address')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="col-md-3">
            <label for="state_id">Estado</label>
            <select name="state_id" id="state_id"
                class="form-control form-control-sm @error('state_id') is-invalid @enderror" title="Estado">
                <option value="{{ $tecnico->state_id ?? old('state_id') }}" selected>
                    {{ $tecnico->state->title ?? 'Selecione o Estado' }}
                </option>
                @foreach ($estado as $key => $uf)
                <option value="{{ $key }}">{{ $uf }}</option>
                @endforeach
            </select>

            @error('state_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="cite_id">Cidade</label>
                <select name="cite_id" id="cite_id"
                    class="form-control form-control-sm @error('cite_id') is-invalid @enderror" title="Cidade">
                    <option value="{{ $tecnico->cite_id ?? '' }}" selected>
                        {{ $tecnico->cities->title ?? 'Selecione a Cidade'}}
                    </option>
                </select>
            </div>


            @error('cite_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

    </div>

    <div class="form-row">

        <div class="col-md-4">
            <label for="agencia">Agencia</label>
            <input id="agencia" type="text" class="form-control form-control-sm @error('agencia') is-invalid @enderror"
                name="agencia" value="{{ $tecnico->agencia ?? old('agencia') }}" required>

            @error('agencia')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="numconta">Número da conta</label>
            <input id="numconta" type="text"
                class="form-control form-control-sm @error('numconta') is-invalid @enderror" name="numconta"
                value="{{ $tecnico->numconta ?? old('numconta') }}" required>

            @error('numconta')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="numbanco">Número do banco</label>
            <input id="numbanco" type="text"
                class="form-control form-control-sm @error('numbanco') is-invalid @enderror" name="numbanco"
                value="{{ $tecnico->numbanco ?? old('numbanco') }}" required>

            @error('numbanco')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

    </div>

    <div class="form-row">

        <div class="col-md-4">
            <label for="operacao">Operação</label>
            <input id="operacao" type="text"
                class="form-control form-control-sm @error('operacao') is-invalid @enderror" name="operacao"
                value="{{ $tecnico->operacao ?? old('operacao') }}" required>

            @error('operacao')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="tipo">Tipo da conta</label>
            <select name="tipo" id="tipo" class="form-control form-control-sm" required>
                <option value="{{ isset($tecnico->tipo) ? $tecnico->tipo : '0' }}">
                    {{ isset($tecnico->tipo) ? 'Poupança' : 'Corrente' }}</option>
                <option value="0">Poupança</option>
                <option value="1">Corrente</option>
            </select>

            @error('tipo')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="favorecido">Favorecido</label>
            <input id="favorecido" type="text"
                class="form-control form-control-sm @error('favorecido') is-invalid @enderror" name="favorecido"
                value="{{ $tecnico->favorecido ?? old('favorecido') }}">

            @error('favorecido')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="customFile">Imagem</label>

            <div class="custom-file">
                <input type="file" class="custom-file-input form-control form-control-sm" id="image" name="image"
                    lang="pt-br">
                <label class="custom-file-label" for="image">Selecione uma imagem</label>
            </div>
        </div>
    </div>
</div>

<div class="card-footer">
    <div class="col-md-6">
        <button type="submit" class="btn btn-flat elevation-3 btn-sm btn-success">
            <i class="fad fa-save"></i> Salvar
        </button>

        <a href="{{ route('dashboard.tecnicos.index') }}" class="btn btn-flat elevation-3 btn-sm btn-danger">
            <i class="fad fa-times"></i> Cancelar
        </a>
    </div>
</div>