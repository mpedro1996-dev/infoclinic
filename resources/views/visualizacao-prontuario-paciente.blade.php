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
							<form method="GET" action="/paciente/prontuario/listar" class="form-horizontal">
								<div class="form-group row">
									<label class="col-md-4 col-form-label text-md-right">Especialidade:</label>
									<div class="col-md-8">
										<select name="especialidade" class="form-control">
											<option value="0">--Selecione--</option>
											@foreach($especialidades as $e)
												<option value="{{$e->id}}" {{$especialidade == $e->id?"selected":""}}>{{$e->nome}}</option>
											@endforeach
										</select>
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
									<th>Nome do Médico</th>
									<th>Especialidade</th>
									<th>Data de Agendamento</th>
									<th colspan="2">Ações</th>
								</tr>
								</thead>
								<tbody id="tabela-corpo">
								@if(count($collection)>0)
									@foreach($collection as $c)
											<tr>
												<td>{{$c->nome_medico}}</td>
												<td>{{$c->nomeEspecialidade}}</td>
												<td>{{date('d/m/Y H:i',strtotime($c->data_agendamento))}}</td>
												<td><a class="btn btn-light" href="/paciente/prontuario/detalhe/{{$c->id}}" title="Mais detalhes" data-toggle="tooltip"><i class="fa fa-search"></i></a></td>
												<td>
													@if($c->bloqueado==0)
														<a href='/paciente/prontuario/mudar-status/{{$c->id}}' class='btn btn-danger btn-sm' data-toggle='tooltip' title='Bloquear'><span class='fa fa-ban'></span></a>
													@else
														<a href='/paciente/prontuario/mudar-status/{{$c->id}}' class='btn btn-primary btn-sm' data-toggle='tooltip' title='Desbloquear'><span class='fa fa-check-circle'></span></a>
													@endif
												</td>
											</tr>
									@endforeach
								@else
									<tr>
										<td colspan="4">Não há dados para exibição</td>
									</tr>
								@endif
								</tbody>
							</table>
							@include('_nav_paginacao_visualizacao_prontuario_consultas_paciente')
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
@endsection