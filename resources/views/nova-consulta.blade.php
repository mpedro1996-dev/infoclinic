@extends('principal')
@section('content')
	@include('_navbar-paciente')
	<script src="{{asset('js/pages/nova-consulta.js')}}"></script>
	<div class="container-fluid">
		<div class="py-4">
			<div class="row justify-content-center">
				<div class="col-md-4">
					@include('_nav-nova-consulta')
				</div>
				<div class="col-md-8">
					@include('mensagens')
					@include('erros')
					<form autocomplete="off">
						<div class="card" id="card-especialidade">
							<div class="card-header bg-primary text-white"><i class="fa fa-list"></i> Escolha a especialidade</div>
							<div class="card-body">
								<div class="form-group row">
									<label for="especialidade_id" class="col-md-3 col-form-label text-md-right">Especialidade</label>
									<div class="col-md-6">
										<select class="form-control" name="especialidade_id" id="especialidade-id">
											<option value="">Selecione</option>
											@foreach($especialidades as $e)
												<option value="{{$e->id}}">{{$e->nome}}</option>
											@endforeach
										</select>
										<div class="invalid-feedback" id="erro-especialidade" style="display: none;">
											Escolha um especialidade
										</div>
									</div>
									<div class="col-md-3">
										<button type="button" class="btn-primary btn" id="btn-enviar-especialidade"> Enviar</button>
									</div>
								</div>
							</div>
						</div>
						<div class="card" id="card-medico" style="display: none;">
							<div class="card-header bg-primary text-white"><i class="fa fa-list"></i> Escolha o Especialista</div>
							<div class="card-body">
								<div class="form-row align-items-center">
									<div class="col-md-3 my-1">
										<input type="text" class="form-control" id="nome-medico" placeholder="Nome do Especialista">
									</div>
									<div class=" my-1">
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="radio-sexo" id="radio-masculino" value="M">
											<label class="form-check-label" for="radio-masculino" title="Masculino" data-toggle="tooltip"><i class="fa fa-2x fa-mars"></i></label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="radio-sexo" id="radio-feminino" value="F">
											<label class="form-check-label" for="radio-feminino" title="Feminino" data-toggle="tooltip"><i class="fa fa-2x fa-venus"></i></label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="radio-sexo" id="radio-irrelevante" value="" checked>
											<label class="form-check-label" for="radio-irrelevante" title="Irrelevante" data-toggle="tooltip"><i class="fa fa-2x fa-genderless"></i></label>
										</div>
										<div class="form-check form-check-inline">
											<input type="checkbox" class="form-check-input" id="medico-checkbox-perto" checked>
											<label for="medico-checkbox-perto" class="form-check-label" title="Perto de mim" data-toggle="tooltip"><i class="fa fa-2x fa-map-marker-alt"></i></label>
										</div>
									</div>
									<div class="col-auto my-1">
										<button type="button" class="btn-primary btn" id="btn-procurar-medico" title="Procurar" data-toggle="tooltip"><i class ="fa fa-search"></i></button>
									</div>
								</div>


								<div class="py-2">
									<table class="table table-hover table-bordered table-striped">
										<thead class="thead-dark">
										<th>Nome do Especialista</th>
										<th>Genero do Especialista</th>
										<th>Tipo de Registro</th>
										<th>Numero do Registro</th>
										<th>Estado do Registro</th>
										<th>Ações</th>
										</thead>
										<tbody id="tbody-medico">
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="card" id="card-local" style="display: none;">
							<div class="card-header bg-primary text-white"><i class="fa fa-list"></i> Escolha a Clínica</div>
							<div class="card-body">
								<div class="form-row align-items-center">
									<div class="col-md-3 my-1">
										<input type="text" class="form-control" id="nome-clinica" placeholder="Nome da Clínica">
									</div>
									<div class="col-md-2 my-1">
										<div class="form-check form-check-inline">
											<input type="checkbox" class="form-check-input" id="clinica-checkbox-perto" checked>
											<label for="clinica-checkbox-perto" class="form-check-label" title="Perto de mim" data-toggle="tooltip"><i class="fa fa-2x fa-map-marker-alt"></i></label>
										</div>
									</div>
									<div class="col-auto my-1">
										<button type="button" class="btn-primary btn" id="btn-procurar-local" title="Procurar" data-toggle="tooltip"><i class ="fa fa-search"></i></button>
									</div>
								</div>


								<div class="py-2">
									<table class="table table-hover table-bordered table-striped">
										<thead class="thead-dark">
										<th>Razão Social</th>
										<th>Dias de Funcionamento</th>
										<th>Horário</th>
										<th>Endereço</th>
										<th>Cidade</th>
										<th>Ações</th>
										</thead>
										<tbody id="tbody-clinica">
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="card" id="card-horario" style="display: none;">
							<div class="card-header bg-primary text-white"><i class="fa fa-list"></i> Escolha a Horário</div>
							<div class="card-body">
								<div class="col-md-12">
									<div class="form-group">
										<label>Selecione o Dia da Semana:</label>
										<div id="div-dias-semana"></div>
									</div>
								</div>
								<div id="div-data-agendamento" style="display: none;">
									<div class="form-group" >
										<div class="col-md-4">
											<label for="data-agendamento">Data de Agendamento:</label>
											<input type="text" id="data-agendamento" class="form-control">
										</div>
									</div>
								</div>
								<div id="div-horario" style="display: none;">
									<div class="form-group">
										<div class="col-md-2">
											<label for="horario-agendamento">Horário:</label>
											<select name="horario-agendamento" id="horario-agendamento" class="form-control"></select>
										</div>
										<div class="col-md-12">
											<div class="invalid-feedback" id="erro-agendamento" style="display: none;">
												Escolha um horário para o agendamentos
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<button type="button" class="btn btn-primary" id="btn-agendar" >Agendar Consulta</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div id="dialog">
			<div data-role="body">
				Agendamento Cadastrado com Sucesso
			</div>
			<div data-role="footer">
				<button type="button" class="btn btn-primary" data-role="close">OK</button>
			</div>
		</div>
	</div>
@endsection