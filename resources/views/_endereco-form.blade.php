<div class="form-group row">
	<label class="col-md-4 col-form-label text-md-right">CEP</label>
	<div class="col-md-3">
		<input id="cep"  maxlength="9" type="text" class="form-control" name="cep" value="{{ old('cep') }}">
	</div>
	<div class="col-md-3" id="mensagem-erro">
		<div id="erro" class="alert-danger"></div>
	</div>
	<div class="col-md-2" id="mensagem-sucesso">
		<div  id="sucesso" class="alert-success"><div class="text-center"><i class="fas fa-check fa-2x"></i></div></div>
	</div>
	<div class="col-md-2" id="mensagem-procurando">
		<div  id="procurando" class="alert-info"><div class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i></div></div>
	</div>
</div>
<div class="form-group row">
	<label class="col-md-4 col-form-label text-md-right">Logradouro</label>
	<div class="col-md-5">
		<input id="logradouro" type="text" class="form-control" name="logradouro" value="{{ old('logradouro') }}">
	</div>
</div>
<div class="form-group row">
	<label class="col-md-4 col-form-label text-md-right">Número</label>
	<div class="col-md-2">
		<input id="numero" type="text" class="form-control" name="numero" value="{{ old('numero') }}">
	</div>
</div>
<div class="form-group row">
	<label class="col-md-4 col-form-label text-md-right">Bairro</label>
	<div class="col-md-5">
		<input id="bairro" type="text" class="form-control" name="bairro" value="{{ old('bairro') }}">
	</div>
</div>
<div class="form-group row">
	<label class="col-md-4 col-form-label text-md-right">Complemento</label>
	<div class="col-md-5">
		<input id="complemento" type="text" class="form-control" name="complemento" value="{{ old('complemento') }}">
	</div>
</div>
<div class="form-group row">
	<label class="col-md-4 col-form-label text-md-right">Cidade</label>
	<div class="col-md-5">
		<input id="cidade" type="text" class="form-control" name="cidade" value="{{ old('cidade') }}">
	</div>
</div>
<div class="form-group row">
	<label class="col-md-4 col-form-label text-md-right">Estado</label>
	<div class="col-md-1">
		<input id="estado" type="text" class="form-control" name="estado" value="{{ old('estado') }}">
	</div>
</div>