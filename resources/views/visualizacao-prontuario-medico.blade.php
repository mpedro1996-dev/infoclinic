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
							<form method="GET" action="/medico/prontuario/listar/{{$id}}" class="form-horizontal">
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
								<div class="form-group row">
									<div class="col-md-4"></div>
									<div class="col-md-8">
										<input type="checkbox" class="form-check-input" name="somente_meus" value="1" {{$somente_meus==1?'checked="checked"':''}}>
										<label class="form-check-label" for="somente_meus">Somente os meus</label>
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
									<th>Especialidade</th>
									<th>Data do Agendamento</th>
									<th>Ações</th>
								</tr>
								</thead>
								<tbody id="tabela-corpo">
								@if(count($collectionConsultas)>0)
									@foreach($collectionConsultas as $c)
										@if($c->bloqueado == 1)
											@if($c->idMedico == Auth::user()->medico->id)
												<tr {{$c->idMedico == Auth::user()->medico->id ?"class=table-primary":"" }}>
													<td>{{$c->nomeEspecialidade}}</td>
													<td>{{date('d/m/Y H:i',strtotime($c->data_agendamento))}}</td>
													<td><a class="btn btn-primary" href="/medico/prontuario/detalhe/{{$c->id}}" title="Mais detalhes" data-toggle="tooltip"><i class="fa fa-search"></i></a></td>
												</tr>
											@endif
										@else

											<tr {{$c->idMedico == Auth::user()->medico->id ?"class=table-primary":"" }}>
												<td>{{$c->nomeEspecialidade}}</td>
												<td>{{date('d/m/Y H:i',strtotime($c->data_agendamento))}}</td>
												<td><a class="btn btn-primary" href="/medico/prontuario/detalhe/{{$c->id}}" title="Mais detalhes" data-toggle="tooltip"><i class="fa fa-search"></i></a></td>
											</tr>
										@endif
									@endforeach
								@else
									<tr>
										<td colspan="3">Não há dados para exibição</td>
									</tr>
								@endif
								</tbody>
							</table>
							@include('_nav_paginacao_visualizacao_prontuario_consultas_medico')
						</div>
					</div>
					<div class="py-4">
						<div class="card">
							<div class="card-header bg-primary text-white"><i class="fa fa-list"></i> Listagem dos Exames </div>
							<div class="card-body">
								@include('mensagens')
								<table class="table table-bordered table-striped table-hover">
									<thead class="thead-dark">
									<tr>
										<th>Descrição</th>
										<th>Data do Cadastro</th>
										<th>Ações</th>
									</tr>
									</thead>
									<tbody id="tabela-corpo">
									@if(count($collectionExames)>0)
										@foreach($collectionExames as $c)
											<tr>
												<td>{{$c->descricao}}</td>
												<td>{{date('d/m/Y H:i',strtotime($c->created_at))}}</td>
												@if($c->nome_arquivo != null)
													<td><a href='{{url(Storage::url('public/exames/'.$c->nome_arquivo))}}' target="_new" class='btn btn-dark btn-sm' data-toggle='tooltip' title='Baixar Anexo'><i class="fas fa-file"></i></a></td>
												@else
													<td><a href='#' target="_new" class='btn btn-dark btn-sm' data-toggle='tooltip' title='Não tem anexo' onclick="desabilitar(event)"><i class="fa fa-info text-white"></i></a></td>
												@endif
											</tr>
										@endforeach
									@else
										<tr>
											<td colspan="3">Não há dados para exibição</td>
										</tr>
									@endif
									</tbody>
								</table>
								@include('_nav_paginacao_visualizacao_prontuario_exames_medico')
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection