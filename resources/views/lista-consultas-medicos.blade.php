@extends('principal')
@section('content')
	@include('_navbar-medico')
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
							<form method="GET" action="/medico/consultas/listar" class="form-horizontal">
								<div class="form-group row">
									<label class="col-md-4 col-form-label text-md-right">Nome da Clínica</label>
									<div class="col-md-8">
										<input name="nome_clinica" type="text" class="form-control">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label text-md-right">Status da Consulta</label>
									<div class="col-md-8">
										<select name="status_consulta" class="form-control">
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
									<th>Especialidade</th>
									<th>Nome da Clínica</th>
									<th>Data de Agendamento</th>
									<th>Status da Consulta</th>
									<th colspan="2">Ações</th>
								</tr>
								</thead>
								<tbody id="tabela-corpo">
								@if(count($collection)>0)
									@foreach($collection as $c)
										<tr>
											<td>{{$c->nomePaciente}}</td>
											<td>{{$c->nomeEspecialidade}}</td>
											<td>{{$c->razao_social}}</td>
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
											@if($c->status == \Infoclinic\Model\Consulta::AGUARDANDO)
												<td><a href='/medico/consultas/abrir/{{$c->id_consulta}}' class='btn btn-primary btn-sm' data-toggle='tooltip' title='Abrir'><i class="fas fa-folder-open"></i></a></td>
												<td><a href='/medico/prontuario/listar/{{$c->id_paciente}}' class='btn btn-danger btn-sm' data-toggle='tooltip' title='Prontuario do Paciente'><i class="fas fa-notes-medical"></i></a></td>
											@elseif($c->status == \Infoclinic\Model\Consulta::FECHADO)
												@if($c->prescricao==1)
													<td><a href='/medico/consultas/prescricao/pdf/{{$c->id_consulta}}' target="_new" class='btn btn-dark btn-sm' data-toggle='tooltip' title='Imprimir a Prescrição'><i class="fas fa-file-prescription"></i></a></td>
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
										<td colspan="6">Não há dados para exibição</td>
									</tr>
								@endif
								</tbody>
							</table>
							@include('_nav_paginacao_consultas_medicos')
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection