@extends('principal')
@section('content')
	@include('_navbar-administrador')
	<script>

        $(document).ready(function () {
            $('#link-endereco').click(function (event) {
                event.preventDefault();
                $(this).addClass("active");
                $('#link-credenciais').removeClass("active");
                $('#body-empresariais').slideUp(100);
                $('#body-endereco').slideDown();
            });
            $('#link-empresariais').click(function (event) {
                event.preventDefault();
                $(this).addClass("active");
                $('#link-endereco').removeClass("active");
                $('#body-endereco').slideUp(100);
                $('#body-empresariais').slideDown();
            });
            $("input[name='rg']").on("focusout",function () {
                $('#link-endereco').addClass("active");
                $('#link-credenciais').removeClass("active");
                $('#body-credenciais').slideUp(100);
                $('#body-endereco').slideDown();

            })
        });

	</script>
    <?php $perfil="administrador"?>
	<div class="container-fluid">
		<form method="POST" action="/clinica/novo">
			<div class="row justify-content-center">
				<div class="col-md-8">
					<div class="py-4">
						<center><h2>Cadastro de Clínicas</h2></center>
						<div class="nova-clinica">
							@include('erros')
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="administrador_id" value="{{Auth::user()->administrador_id}}">
							<div class="card card-default">
								<div class="card-header"><i class="fa fa-user"></i> Dados Pessoais</div>
								<div class="card-body">
									@include('dados-pessoais-form')
									<div class="form-group row">
										<label class="col-md-4 col-form-label text-md-right">
											E-Mail
										</label>
										<div class="col-md-6">
											<input type="email" name="email" value="{{old('email')}}" class="form-control">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header">
							<ul class="nav nav-tabs card-header-tabs">
								<li class="nav-item">
									<a class="nav-link active" id="link-endereco" href="#"><i class="fa fa-map-marker-alt"></i> Endereço</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="link-empresariais" href="#"><i class="far fa-hospital"></i> Empresariais</a>
								</li>
							</ul>
						</div>
						<div class="card-body" id="body-endereco" style="display: block" >
							@include('_endereco-form')
						</div>
						<div class="card-body" id="body-empresariais">
							<div class="form-group row">
								<label class="col-md-4 col-form-label text-md-right">
									CNPJ:
								</label>
								<div class="col-md-3">
									<input id="cnpj" maxlength="18" type="text" name="cnpj" class="form-control" value="{{ old('cnpj') }}">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-4 col-form-label text-md-right">Razão Social</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="razao_social" value="{{ old('razao_social') }}">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-4 col-form-label text-md-right">Data de Inauguração</label>
								<div class="col-md-8">
									<input type="date" class="form-control" name="data_inauguracao" value="{{ old('data_inauguracao') }}">
								</div>
							</div>
							<div class="form-group row">
								<label for="descricao" class="col-md-4 col-form-label text-md-right">Descrição da Clínica</label>
								<div class="col-md-8">
									<textarea name="descricao" class="form-control">{{ old('descricao') }}</textarea>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-4 col-form-label text-md-right">Dias de Funcionamento</label>
								<div class="col-md-8">
									<div class="checkbox">
										<label><input type="checkbox" name="domingo" value="1">Domingo</label><br>
										<label><input type="checkbox" name="segunda" value="1">Segunda-Feira</label><br>
										<label><input type="checkbox" name="terca" value="1">Terça-Feira</label><br>
										<label><input type="checkbox" name="quarta" value="1">Quarta-Feira</label><br>
										<label><input type="checkbox" name="quinta" value="1">Quinta-Feira</label><br>
										<label><input type="checkbox" name="sexta" value="1">Sexta-Feira</label><br>
										<label><input type="checkbox" name="sabado" value="1">Sábado</label>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label for="horarioInicioFunc" class="col-md-4 col-form-label text-md-right">Hórarios de Funcionamento</label>
								<label class="col-form-label text-md-right col-md-1">Das</label>
								<div class="col-md-3"><input type="time" name="horario_inicio_func" class="form-control"></div>
								<label for="horarioFimFunc" class="col-md-1 col-form-label text-md-right">Até</label>
								<div class="col-md-3"><input type="time" name="horario_fim_func" class="form-control"></div>
							</div>
							<div class="card">
								<div class="card-header bg-info text-white"><i class="fa fa-map-marker-alt"></i> Endereço da Clínica</div>
								<div class="card-body">
									<div class="form-group row">
										<label class="col-md-4 col-form-label text-md-right">CEP</label>
										<div class="col-md-3">
											<input id="cep_clinica"  maxlength="9" type="text" class="form-control" name="cep_clinica" value="{{ old('cep_clinica') }}">
										</div>
										<div class="col-md-2" id="mensagem-erro-clinica">
											<div id="erro-clinica" class="alert-danger"></div>
										</div>
										<div class="col-md-1" id="mensagem-sucesso-clinica">
											<div  id="sucesso-clinica" class="alert-success">
												<div class="text-center"><div class="text-center"><i class="fas fa-check fa-2x"></i></div></div>
											</div>
										</div>
										<div class="col-md-1" id="mensagem-procurando-clinica">
											<div  id="procurando-clinica" class="alert-info">
												<div  id="procurando" class="alert-info"><div class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i></div></div>
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-4 col-form-label text-md-right">Logradouro</label>
										<div class="col-md-8">
											<input id="logradouro_clinica" type="text" class="form-control" name="logradouro_clinica" value="{{ old('logradouro_clinica') }}">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-4 col-form-label text-md-right">Número</label>
										<div class="col-md-8">
											<input id="numero_clinica" type="text" class="form-control" name="numero_clinica" value="{{ old('numero_clinica') }}">
										</div>
									</div>
									<div class="form-group row row">
										<label class="col-md-4 col-form-label text-md-right">Bairro</label>
										<div class="col-md-8">
											<input id="bairro_clinica" type="text" class="form-control" name="bairro_clinica" value="{{ old('bairro_clinica') }}">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-4 col-form-label text-md-right">Complemento</label>
										<div class="col-md-8">
											<input id="complemento_clinica" type="text" class="form-control" name="complemento_clinica" value="{{ old('complemento_clinica') }}">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-4 col-form-label text-md-right">Cidade</label>
										<div class="col-md-8">
											<input id="cidade_clinica" type="text" class="form-control" name="cidade_clinica" value="{{ old('cidade_clinica') }}">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-4 col-form-label text-md-right">Estado</label>
										<div class="col-md-8">
											<input id="estado_clinica" type="text" class="form-control" name="estado_clinica" value="{{ old('estado_clinica') }}">
										</div>
									</div>
								</div>
							</div>
							<div class="py-4">
								<div class="form-group row">
									<div class="col-md-8 ml-auto">
										<button type="submit" class="btn btn-primary">
											Enviar
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
@endsection