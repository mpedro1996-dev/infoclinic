@extends('principal')
@section('content')
	@include('_navbar-'.$navbar)
	<div class="container-fluid">
		<div class="py-4">
			<div class="row justify-content-center">
				<div class="col-md-8">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> Tem problemas com sua entrada de dados:<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					<form class="form-horizontal" role="form" method="POST" action="/usuario/editado">
						<div class="card">
							<div class="card-header"><i class="fa fa-user"></i> Dados Pessoais</div>
							<div class="card-body">
								@csrf
								<input type="hidden" name="id" value="{{$usuario->id}}">
								<input type="hidden" name="ultimaRequest" value="{{$path}}">
								<div class="form-group row">
									<label class="col-md-4 col-form-label text-md-right">Nome</label>
									<div class="col-md-5">
										<input type="text" class="form-control" name="nome" value="{{$usuario->nome}}">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label text-md-right">Telefone</label>
									<div class="col-md-2">
										<input id="telefone" maxlength="13" type="text" class="form-control" name="telefone" value="{{$usuario->telefone}}">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label text-md-right">Celular</label>
									<div class="col-md-2">
										<input id="celular" maxlength="14" type="text" class="form-control" name="celular" value="{{$usuario->celular}}">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label text-md-right">RG</label>
									<div class="col-md-3">
										<input type="text" class="form-control" name="rg" value="{{$usuario->rg}}">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label text-md-right">Data de Nascimento</label>
									<div class="col-md-3">
										<input type="date" class="form-control" name="data_nascimento" value="{{$usuario->data_nascimento}}">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label text-md-right">E-mail</label>
									<div class="col-md-5">
										<input type="email" class="form-control" name="email" value="{{$usuario->email}}">
									</div>
								</div>
							</div>
						</div>
						<div class="py-4">
							<div class="card">
								<div class="card-header"><i class="fa fa-map-marker-alt"></i> Endereço</div>
								<div class="card-body">
									<div class="form-group row">
										<label class="col-md-4 col-form-label text-md-right">CEP</label>
										<div class="col-md-3">
											<input id="cep"  maxlength="9" type="text" class="form-control" name="cep" value="{{ $usuario->cep }}">
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
											<input id="logradouro" type="text" class="form-control" name="logradouro" value="{{ $usuario->logradouro }}">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-4 col-form-label text-md-right">Número</label>
										<div class="col-md-2">
											<input id="numero" type="text" class="form-control" name="numero" value="{{ $usuario->numero }}">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-4 col-form-label text-md-right">Bairro</label>
										<div class="col-md-5">
											<input id="bairro" type="text" class="form-control" name="bairro" value="{{ $usuario->bairro }}">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-4 col-form-label text-md-right">Complemento</label>
										<div class="col-md-5">
											<input id="complemento" type="text" class="form-control" name="complemento" value="{{ $usuario->complemento }}">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-4 col-form-label text-md-right">Cidade</label>
										<div class="col-md-5">
											<input id="cidade" type="text" class="form-control" name="cidade" value="{{ $usuario->cidade }}">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-4 col-form-label text-md-right">Estado</label>
										<div class="col-md-1">
											<input id="estado" type="text" class="form-control" name="estado" value="{{ $usuario->estado }}">
										</div>
									</div>
								</div>
							</div>
						</div>
						@if($usuario->paciente_id!=null)
							<div class="card">
								<div class="card-header"><i class="fa fa-heartbeat"></i> Dados de Paciente</div>
								<div class="card-body">
									<div class="form-group row">
										<label class="col-md-4 col-form-label text-md-right">Tipo Sanguineo</label>
										<div class="col-md-2">
											<select name="tipo_sanguineo" class="form-control">
												<option value="" {{$usuario->paciente->tipo_sanguineo==null?'selected':''}}></option>

												<option value="A" {{$usuario->paciente->tipo_sanguineo=='A'?'selected':''}}>A</option>
												<option value="B" {{$usuario->paciente->tipo_sanguineo=='B'?'selected':''}}>B</option>
												<option value="AB"{{$usuario->paciente->tipo_sanguineo=='AB'?'selected':''}}>AB</option>
												<option value="O" {{$usuario->paciente->tipo_sanguineo=='O'?'selected':''}}>O</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-4 col-form-label text-md-right">Fator RH</label>
										<div class="col-md-3">
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="fator_rh" id="radio_positivo" value="1" {{$usuario->paciente->fator_rh==1?"checked":""}}>
												<label class="form-check-label" for="radio_positivo" title="Positivo" data-toggle="tooltip"><i class="fa fa-plus fa-2x" style="color:#28a745!important;"></i></label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="fator_rh" id="radio_negativo" value="0" {{$usuario->paciente->fator_rh==0?"checked":""}}>
												<label class="form-check-label" for="radio_negativo" title="Negativo" data-toggle="tooltip"><i class="fa fa-minus fa-2x text-danger	"></i></label>
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label for="peso" class="col-md-4 col-form-label text-md-right">Peso</label>
										<div class="col-md-2">
											<input type="number" class="form-control" name="peso" value="{{$usuario->paciente->peso}}">
										</div>
										<label for="altura" class="col-md-3 col-form-label text-md-right">Altura</label>
										<div class="col-md-2">
											<input type="number" step="0.01" class="form-control" name="altura" value="{{$usuario->paciente->altura}}">
										</div>
									</div>

									<div class="form-group row">
										<label class="col-md-4 col-form-label text-md-right">Estado Civil</label>
										<div class="col-md-3">
											<select class="form-control" name="estado_civil">
												<option value="solteiro" {{$usuario->paciente->estado_civil == "solteiro"?"selected":""}}>Solteiro(a)</option>
												<option value="casado" {{$usuario->paciente->estado_civil == "casado"?"selected":""}}>Casado(a)</option>
												<option value="divorciado" {{$usuario->paciente->estado_civil == "divorciado"?"selected":""}}>Divorciado(a)</option>
												<option value="viuvo" {{$usuario->paciente->estado_civil == "viuvo"?"selected":""}}>Viúvo(a)</option>
												<option value="separado" {{$usuario->paciente->estado_civil == "separado"?"selected":""}}>Separado(a)</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-4 col-form-label text-md-right">Sexo</label>
										<div class="col-md-3">
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="sexo" id="radio_m" value="M" {{$usuario->paciente->sexo=="M"?"checked":""}}>
												<label class="form-check-label" for="radio_m">Masculino</label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="sexo" id="radio_f" value="F" {{$usuario->paciente->sexo=="F"?"checked":""}}>
												<label class="form-check-label" for="radio_f">Feminino</label>
											</div>
										</div>
									</div>
								</div>
							</div>
						@endif
						@if($usuario->clinica_id!=null)
							<div class="py-4">
								<div class="card">
									<div class="card-header"> <i class="fa fa-plus-square"></i> Dados de Clínica</div>
									<div class="card-body">
										<div class="form-group row">
											<label for="razao_social" class="col-md-4 col-form-label text-md-right">Razão Social</label>
											<div class="col-md-8">
												<input type="text" name="razao_social" class="form-control" value="{{$usuario->clinica->razao_social}}">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-md-4 col-form-label text-md-right">Data de Inauguração</label>
											<div class="col-md-8">
												<input type="date" class="form-control" name="data_inauguracao" value="{{ $usuario->clinica->data_inauguracao }}">
											</div>
										</div>
										<div class="form-group row">
											<label for="descricao" class="col-md-4 col-form-label text-md-right">Descrição da Clínica</label>
											<div class="col-md-8">
												<textarea name="descricao" class="form-control">{{$usuario->clinica->descricao}}</textarea>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-md-4 col-form-label text-md-right">Dias de Funcionamento</label>
											<div class="col-md-8">
												<div class="checkbox">
													<label><input type="checkbox" name="domingo" value="1" {{$usuario->clinica->domingo==1?'checked':''}} >Domingo</label><br>
													<label><input type="checkbox" name="segunda" value="1" {{$usuario->clinica->segunda==1?'checked':''}}>Segunda-Feira</label><br>
													<label><input type="checkbox" name="terca" value="1" {{$usuario->clinica->terca==1?'checked':''}}>Terça-Feira</label><br>
													<label><input type="checkbox" name="quarta" value="1" {{$usuario->clinica->quarta==1?'checked':''}}>Quarta-Feira</label><br>
													<label><input type="checkbox" name="quinta" value="1" {{$usuario->clinica->quinta==1?'checked':''}}>Quinta-Feira</label><br>
													<label><input type="checkbox" name="sexta" value="1" {{$usuario->clinica->sexta==1?'checked':''}}>Sexta-Feira</label><br>
													<label><input type="checkbox" name="sabado" value="1" {{$usuario->clinica->sabado==1?'checked':''}}>Sábado</label>
												</div>
											</div>
										</div>
										<div class="form-group row">
											<label for="horarioInicioFunc" class="col-md-4 col-form-label text-md-right">Hórario de Funcionamento</label>
											<label class="col-form-label text-md-right col-md-1">Das</label>
											<div class="col-md-3"><input type="time" name="horario_inicio_func" class="form-control" value="{{$usuario->clinica->horario_inicio_func}}"></div>
											<label class="col-form-label text-md-right col-md-1">Até</label>
											<div class="col-md-3"><input type="time" name="horario_fim_func" class="form-control" value="{{$usuario->clinica->horario_fim_func}}"></div>
										</div>
										<div class="card">
											<div class="card-header text-white bg-info"><i class="fa fa-map-marker-alt"></i> Endereço da Clínica</div>
											<div class="card-body">
												<div class="form-group row">
													<label class="col-md-4 col-form-label text-md-right">CEP</label>
													<div class="col-md-3">
														<input id="cep_clinica"  maxlength="9" type="text" class="form-control" name="cep_clinica" value="{{ $usuario->clinica->cep_clinica }}">
													</div>
													<div class="col-md-3" id="mensagem-erro-clinica">
														<div id="erro" class="alert-danger"></div>
													</div>
													<div class="col-md-2" id="mensagem-sucesso-clinica">
														<div  id="sucesso" class="alert-success"><div class="text-center"><i class="fas fa-check fa-2x"></i></div></div>
													</div>
													<div class="col-md-2" id="mensagem-procurando-clinica">
														<div  id="procurando" class="alert-info"><div class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i></div></div>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-md-4 col-form-label text-md-right">Logradouro</label>
													<div class="col-md-5">
														<input id="logradouro_clinica" type="text" class="form-control" name="logradouro_clinica" value="{{ $usuario->clinica->logradouro_clinica }}">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-md-4 col-form-label text-md-right">Número</label>
													<div class="col-md-2">
														<input id="numero_clinica" type="text" class="form-control" name="numero_clinica" value="{{ $usuario->clinica->numero_clinica }}">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-md-4 col-form-label text-md-right">Bairro</label>
													<div class="col-md-5">
														<input id="bairro_clinica" type="text" class="form-control" name="bairro_clinica" value="{{ $usuario->clinica->bairro_clinica }}">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-md-4 col-form-label text-md-right">Complemento</label>
													<div class="col-md-5">
														<input id="complemento_clinica" type="text" class="form-control" name="complemento_clinica" value="{{ $usuario->clinica->complemento_clinica }}">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-md-4 col-form-label text-md-right">Cidade</label>
													<div class="col-md-5">
														<input id="cidade_clinica" type="text" class="form-control" name="cidade_clinica" value="{{ $usuario->clinica->cidade_clinica }}">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-md-4 col-form-label text-md-right">Estado</label>
													<div class="col-md-1">
														<input id="estado_clinica" type="text" class="form-control" name="estado_clinica" value="{{ $usuario->clinica->estado_clinica }}">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						@endif
						<div class="py-4">
							<div class="row">
								<div class="col-md-2 ml-auto">
									<button type="submit" class="btn btn-primary">
										Enviar
									</button>
									<a href="javascript:history.go(-1)" class="btn btn-light"><i class="fa fa-arrow-left"></i> Voltar</a>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection