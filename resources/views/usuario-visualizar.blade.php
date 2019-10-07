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
					<div class="form-group">
						<a href="javascript:history.go(-1)" class="btn btn-primary"><span class="fa fa-arrow-left"></span> Voltar</a>
					</div>
					<div class="py-4">
						<div class="card ">
							<div class="card-header"><span class="fa fa-user"></span> Dados Pessoais</div>
							<div class="card-body">
								<p><b>ID de Usuário:</b> {{$usuario->id}}</p>
								<p><b>Nome:</b> {{$usuario->nome}}</p>
								<p><b>Telefone:</b> {{$usuario->telefone}}</p>
								<p><b>Celular:</b> {{$usuario->celular}}</p>
								<p><b>RG:</b> {{$usuario->rg}}</p>
								<p><b>Data de Nascimento:</b> {{date('d/m/Y',strtotime($usuario->data_nascimento))}}</p>

								<p><b>E-mail: </b>{{$usuario->email}}</p>
							</div>
						</div>
					</div>
					<div class="py-4">
						<div class="card ">
							<div class="card-header"><i class="fa fa-map-marker-alt"></i> Endereço</div>
							<div class="card-body">
								<p><b>CEP: </b>{{$usuario->cep}}</p>
								<p><b>Logradouro: </b>{{$usuario->logradouro}}</p>
								<p><b>Número: </b>{{$usuario->numero}}</p>
								<p><b>Bairro: </b>{{$usuario->bairro}}</p>
								<p><b>Complemento: </b>{{$usuario->complemento}}</p>
								<p><b>Cidade: </b>{{$usuario->cidade}}</p>
								<p><b>Estado: </b>{{$usuario->estado}}</p>
							</div>
						</div>
					</div>

					@if($usuario->paciente_id!=null)
						<div class="py-4">
							<div class="card ">
								<div class="card-header"><i class="fas fa-heartbeat"></i> Dados de Paciente</div>
								<div class="card-body">
									<p><b>CPF: </b>{{$usuario->paciente->cpf}}</p>
									<p><b>Tipo Sanguíneo: </b>{{$usuario->paciente->tipo_sanguineo}}</p>
									<p><b>Fator RH: </b> <label class="form-check-label" title="{{$usuario->paciente->fator_rh==1?"Positivo":"Negativo"}}" data-toggle="tooltip"><i class="{{$usuario->paciente->fator_rh==1?"fa fa-plus":"fa fa-minus"}} fa-2x"></i></label></p>
								</div>
							</div>
						</div>
					@endif
					@if($usuario->clinica_id!=null)
						<div class="py-4">
							<div class="card ">
								<div class="card-header"><i class="far fa-hospital"></i> Dados da Clínica</div>
								<div class="card-body">
									<p><b>CNPJ:</b> {{$usuario->clinica->cnpj}}
									<p><b>Razão Social:</b> {{$usuario->clinica->razao_social}}
									<p><b>Descrição da Clínica:</b></p>
									{!!$usuario->clinica->descricao!!}
									<p><b>Data de Inauguração:</b> {{date('d/m/Y',strtotime($usuario->clinica->data_inauguracao))}}</p>
									<p><b>Horário de Funcionamento:</b></p>
									@if($usuario->clinica->domingo==1||$usuario->clinica->segunda==1||$usuario->clinica->terca==1||$usuario->clinica->quarta==1||$usuario->clinica->quinta==1||$usuario->clinica->sexta==1||$usuario->clinica->sabado==1)
										<ul>
											{!!$usuario->clinica->domingo==1?'<li>Domingo</li>':''!!}
											{!!$usuario->clinica->segunda==1?'<li>Segunda-Feira</li>':''!!}
											{!!$usuario->clinica->terca==1?'<li>Terça-Feira</li>':''!!}
											{!!$usuario->clinica->quarta==1?'<li>Quarta-Feira</li>':''!!}
											{!!$usuario->clinica->quinta==1?'<li>Quinta-Feira</li>':''!!}
											{!!$usuario->clinica->sexta==1?'<li>Sexta-Feira</li>':''!!}
											{!!$usuario->clinica->sabado==1?'<li>Domingo</li>':''!!}
										</ul>
									@else
										<div class="alert alert-warning">Dias Indefinidos</div>
									@endif
									<p><b>Das: </b>{{date('H:i',strtotime($usuario->clinica->horario_inicio_func))}}h <b>até:</b> {{date('H:i',strtotime($usuario->clinica->horario_fim_func))}}h</p>
									<p><b>Administrador do Infoclinic:</b> {{$usuario->clinica->administrador->usuario->nome}}</p>
									<div class="py-4">
										<div class="card ">
											<div class="card-header bg-info text-white"><i class="fa fa-map-marker-alt"></i> Endereço da Clínica</div>
											<div class="card-body">
												<p><b>CEP: </b>{{$usuario->clinica->cep_clinica}}</p>
												<p><b>Logradouro: </b>{{$usuario->clinica->logradouro_clinica}}</p>
												<p><b>Número: </b>{{$usuario->clinica->numero_clinica}}</p>
												<p><b>Bairro: </b>{{$usuario->clinica->bairro_clinica}}</p>
												<p><b>Complemento: </b>{{$usuario->clinica->complemento_clinica}}</p>
												<p><b>Cidade: </b>{{$usuario->clinica->cidade_clinica}}</p>
												<p><b>Estado: </b>{{$usuario->clinica->estado_clinica}}</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					@endif
				</div>
			</div>
		</div>
@endsection