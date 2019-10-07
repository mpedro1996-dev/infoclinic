@extends('principal')
@section('content')
	@include('_navbar-paciente')
	<script>
        function desabilitar(e) {
            e.preventDefault();

        }
	</script>
	<div class	="container-fluid">
		<div class="py-4">
			<div class="row justify-content-center">
				<div class="col-md-4">
					<div class="card">
						<div class="card-header bg-info text-white"><i class="fa fa-search"></i> Procurar</div>
						<div class=card-body>
							<form method="GET" action="/paciente/consultas/listar" class="form-horizontal">
								<div class="form-group row">
									<label class="col-md-4 col-form-label text-md-right">Nome do Médico</label>
									<div class="col-md-8">
										<input name="nome_medico" type="text" class="form-control">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label text-md-right">Nome da Clínica</label>
									<div class="col-md-8">
										<input name="nome_clinica" type="text" class="form-control">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label text-md-right">Status de Consulta</label>
									<div class="col-md-8">
										<select name="status_consulta" class="form-control">
											<option value="{{\Infoclinic\Model\Consulta::AGENDADO}}"> Agendado</option>
											<option value="{{\Infoclinic\Model\Consulta::FECHADO}}"> Fechado</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-4"></div>
									<div class="col-md-8">
										<input type="checkbox" class="form-check-input" name="data_hoje" value="1" {{$data_hoje==1?'checked="checked"':''}}>
										<label class="form-check-label" for="data_hoje">Hoje</label>
									</div>
								</div>
								@include('_form-consulta')
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="card">
						<div class="card-header bg-primary text-white"><i class="fa fa-list"></i> Listagem das Consultas </div>
						<div class="card-body">
							@include('mensagens')
							<table class="table table-bordered table-striped table-hover">
								<thead class="thead-dark">
								<tr>
									<th>Nome do Clínica</th>
									<th>Nome do Médico</th>
									<th>Especialidade</th>
									<th>Data de Agendamento</th>
									<th>Status de Consulta</th>
									<th colspan="2">Ações</th>
								</tr>
								</thead>
								<tbody id="tabela-corpo">
								@if(count($collection)>0)
									@foreach($collection as $c)
										<tr>
											<td>{{$c->nomeClinica}}</td>
											<td>{{$c->nomeMedico}}</td>
											<td>{{$c->nomeEspecialidade}}</td>
											<td>{{date('d/m/Y H:i',strtotime($c->data_agendamento))}}</td>
											<td>
												@if($c->status==\Infoclinic\Model\Consulta::AGENDADO)
													Agendado
												@endif
												@if($c->status==\Infoclinic\Model\Consulta::AGUARDANDO)
													Aguardando Atendimento
												@endif
												@if($c->status==\Infoclinic\Model\Consulta::ABERTO)
													Aberto
												@endif
												@if($c->status==\Infoclinic\Model\Consulta::FECHADO)
													Fechado
												@endif
											</td>
											@if($c->status == \Infoclinic\Model\Consulta::AGENDADO)
												@if($c->desmarcavel == 1)
													<td><a href='/paciente/consultas/salvar-cancelamento/{{$c->id}}' class='btn btn-danger btn-sm' data-toggle='tooltip' title='Cancelar Consulta'><i class="fas fa-times"></i></a></td>
												@else
													<td><a href='#' target="_new" class='btn btn-dark btn-sm' data-toggle='tooltip' title='Não há ações para ser executado' onclick="desabilitar(event)"><i class="fa fa-info text-white"></i></a></td>
												@endif
											@elseif($c->status == \Infoclinic\Model\Consulta::FECHADO)
												@if($c->marcavel == 1)
													<td><a href='#' class='btn btn-primary btn-sm' data-toggle='tooltip' id="btn-retorno"  data-id="{{$c->id}}" title='Marcar Retorno'><i class="fas fa-calendar-plus"></i></a></td>
												@else
													<td><a href='#' target="_new" class='btn btn-dark btn-sm' data-toggle='tooltip' title='Não há ações para ser executado' onclick="desabilitar(event)"><i class="fa fa-info text-white"></i></a></td>
												@endif
											@else
												<td><a href='#' target="_new" class='btn btn-dark btn-sm' data-toggle='tooltip' title='Não há ações para ser executado' onclick="desabilitar(event)"><i class="fa fa-info text-white"></i></a></td>
											@endif

										</tr>

									@endforeach
								@else
									<tr>
										<td colspan="5">Não há dados para exibição</td>
									</tr>
								@endif
								</tbody>
							</table>
							@include('_nav_paginacao_consultas_pacientes')
						</div>
					</div>
				</div>
			</div>
		</div>
		@include('modal-cadastrar-retorno')
	</div>
@endsection