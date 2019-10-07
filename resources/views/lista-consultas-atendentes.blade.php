@extends('principal')
@section('content')
	@include('_navbar-atendente')
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
							<form method="GET" action="/atendente/consultas/listar" class="form-horizontal">
								<div class="form-group row">
									<label class="col-md-4 col-form-label text-md-right">Nome do Médico</label>
									<div class="col-md-8">
										<input name="nome_medico" type="text" class="form-control">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label text-md-right">Nome do Paciente</label>
									<div class="col-md-8">
										<input name="nome_paciente" type="text" class="form-control">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label text-md-right">Status da Consulta</label>
									<div class="col-md-8">
										<select name="status_consulta" class="form-control">
											<option value="">--Selecione--</option>
											<option value="{{\Infoclinic\Model\Consulta::AGENDADO}}"> Agendado</option>
											<option value="{{\Infoclinic\Model\Consulta::AGUARDANDO}}"> Aguardando Atendimento</option>
											<option value="{{\Infoclinic\Model\Consulta::ABERTO}}"> Aberto </option>
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
									<th>Nome do Paciente</th>
									<th>Nome do Médico</th>
									<th>Data de Agendamento</th>
									<th>Status da Consulta</th>
									<th colspan="4">Ações</th>
								</tr>
								</thead>
								<tbody id="tabela-corpo">
								@if(count($collection)>0)
									@foreach($collection as $c)
										<tr>
											<td>{{$c->nomePaciente}}</td>
											<td>{{$c->nomeMedico}}</td>
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
												<td><a href='/atendente/consultas/mudar-status/{{$c->id}}' class='btn btn-primary btn-sm' data-toggle='tooltip' title='Entrada na Consulta'><i class="fas fa-folder-open"></i></a></td>
												<td><a href='/atendente/consultas/cancelar/{{$c->id}}' class='btn btn-danger btn-sm' data-toggle='tooltip' title='Cancelar Consulta'><i class="fas fa-times"></i></a></td>
												<td><a href='/atendente/consultas/cancelar-por-falta/{{$c->id}}' class='btn btn-warning btn-sm text-white' data-toggle='tooltip' title='Falta do Paciente'><i class="fas fa-times-circle"></i></a></td>

											@elseif($c->status == \Infoclinic\Model\Consulta::FECHADO)
												@if($c->marcavel == 1)
													<td colspan="3"><a href='#' class='btn btn-primary btn-sm' data-toggle='tooltip' id="btn-retorno"  data-id="{{$c->id}}" title='Marcar Retorno'><i class="fas fa-calendar-plus"></i></a></td>
												@else
													<td colspan="3"><a href='#' target="_new" class='btn btn-dark btn-sm' data-toggle='tooltip' title='Não há ações para ser executado' onclick="desabilitar(event)"><i class="fa fa-info text-white"></i></a></td>
												@endif
											@else
												<td colspan="3"><a href='#' target="_new" class='btn btn-dark btn-sm' data-toggle='tooltip' title='Não há ações para ser executado' onclick="desabilitar(event)"><i class="fa fa-info text-white"></i></a></td>
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
							@include('_nav_paginacao_consultas_atendentes')
						</div>
					</div>
				</div>
			</div>
		</div>
		@include('modal-cadastrar-retorno')
	</div>
@endsection