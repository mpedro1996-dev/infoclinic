<div class="form-group row">
	<label class="col-md-4 col-form-label text-md-right">
		CPF
	</label>
	<div class="col-md-2">
		<input id="cpf" maxlength="14" type="text" name="cpf" class="form-control" value="{{old('cpf')}}">
	</div>
</div>
<div class="form-group row">
	<label class="col-md-4 col-form-label text-md-right">Nome</label>
	<div class="col-md-5">
		<input type="text" class="form-control" name="nome" value="{{ old('nome') }}">
	</div>
</div>
<div class="form-group row">
	<label class="col-md-4 col-form-label text-md-right">Telefone</label>
	<div class="col-md-2">
		<input id="telefone" maxlength="13" type="text" class="form-control" name="telefone" value="{{ old('telefone') }}">
	</div>
</div>
<div class="form-group row">
	<label class="col-md-4 col-form-label text-md-right">Celular</label>
	<div class="col-md-2">
		<input id="celular" maxlength="14" type="text" class="form-control" name="celular" value="{{ old('celular') }}">
	</div>
</div>
<div class="form-group row">
	<label class="col-md-4 col-form-label text-md-right">Tipo Sanguíneo</label>
	<div class="col-md-1">
		<select class="form-control" name="tipo_sanguineo">
			<option value=""></option>
			<option value="A" {{old('tipo_sanguineo')=='A'?'selected':''}}>A</option>
			<option value="B" {{old('tipo_sanguineo')=='B'?'selected':''}}>B</option>
			<option value="AB"{{old('tipo_sanguineo')=='AB'?'selected':''}}>AB</option>
			<option value="O" {{old('tipo_sanguineo')=='O'?'selected':''}}>O</option>
		</select>
	</div>
	<label class="col-md-4 col-form-label text-md-right">Fator RH</label>
	<div class="col-md-3">
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="fator_rh" id="radio_positivo" value="1" {{old('fator_rh')==1?'checked=checked':''}}>
			<label class="form-check-label" for="radio_positivo" title="Positivo" data-toggle="tooltip" ><i class="fa fa-plus fa-2x" style="color:#28a745!important;"></i></label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="fator_rh" id="radio_negativo" value="0" {{old('fator_rh')==0?'checked=checked':''}}>
			<label class="form-check-label" for="radio_negativo" title="Negativo" data-toggle="tooltip"><i class="fa fa-minus fa-2x text-danger	"></i></label>
		</div>
	</div>
</div>
<div class="form-group row">
	<label for="peso" class="col-md-4 col-form-label text-md-right">Peso</label>
	<div class="col-md-2">
		<input type="number" class="form-control" name="peso" value="{{old('peso')}}">
	</div>
	<label for="altura" class="col-md-3 col-form-label text-md-right">Altura</label>
	<div class="col-md-2">
		<input type="number" step="0.01" class="form-control" name="altura" value="{{old('altura')}}">
	</div>
</div>
<div class="form-group row">
	<label class="col-md-4 col-form-label text-md-right">Data de Nascimento</label>
	<div class="col-md-3">
		<input type="date" class="form-control" name="data_nascimento" value="{{ old('data_nascimento') }}">
	</div>
</div>
<div class="form-group row">
	<label class="col-md-4 col-form-label text-md-right">RG</label>
	<div class="col-md-3">
		<input type="text" class="form-control" name="rg" value="{{ old('rg') }}">
	</div>
</div>
<div class="form-group row">
	<label class="col-md-4 col-form-label text-md-right">Estado Civil</label>
	<div class="col-md-3">
		<select class="form-control" name="estado_civil">
			<option value="solteiro" {{old('tipo_sanguineo')=='solteiro'?'selected':''}}>Solteiro(a)</option>
			<option value="casado" {{old('tipo_sanguineo')=='casado'?'selected':''}}>Casado(a)</option>
			<option value="divorciado" {{old('tipo_sanguineo')=='divorciado'?'selected':''}}>Divorciado(a)</option>
			<option value="viuvo" {{old('tipo_sanguineo')=='viuvo'?'selected':''}}>Viúvo(a)</option>
			<option value="separado" {{old('tipo_sanguineo')=='separado'?'selected':''}}>Separado(a)</option>
		</select>
	</div>
</div>
<div class="form-group row">
	<label class="col-md-4 col-form-label text-md-right">Sexo</label>
	<div class="col-md-3">
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="sexo" id="radio_m" value="M" {{old('sexo')=='M'?'checked=checked':''}}>
			<label class="form-check-label" for="radio_m">Masculino</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="sexo" id="radio_f" value="F" {{old('sexo')=='F'?'checked=checked':''}}>
			<label class="form-check-label" for="radio_f">Feminino</label>
		</div>
	</div>
</div>
