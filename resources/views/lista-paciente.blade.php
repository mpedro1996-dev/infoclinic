@extends('principal')
@section('content')
	@include('_navbar-'.$navbar)
	<div class="container-fluid">
		<div class="py-4">
			<div class="row justify-content-center">
				<div class="col-md-4">
					<div class="card">
						<div class="card-header bg-info text-white"><span class="fa fa-search"></span> Procurar</div>
						<div class=card-body>
							<form method="GET" action={{$navbar=='clinica'?"clinica/paciente/listar":"administrador/paciente/listar"}} class="form-horizontal">
								<div class="form-group row">
									<label class="col-md-3 col-form-label text-md-right">{{$labelConsulta}}</label>
									<div class="col-md-9">
										<input name="consulta" type="text" maxlength="14" id="cpf_busca" class="form-control">
									</div>
								</div>
								@include('_form-consulta')
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="card">
						<div class="card-header bg-primary text-white"><span class="fa fa-list"></span> Listagem dos Pacientes</div>
						<div class="card-body">
							@include('mensagens')
							<table class="table table-bordered table-striped table-hover">
								<thead class="thead-dark">
								<tr>
									<th>ID de Paciente</th>
									<th>Nome</th>
									<th>Data de Nascimento</th>
									<th>RG</th>
									<th>CPF</th>
									<th colspan="2">Ação</th>
								</tr>
								</thead>
								<tbody id="tabela-corpo">
								@foreach($collection as $c)
									<tr>
										<td>{{$c->paciente_id}}</td>
										<td>{{$c->nome}}</td>
										<td>{{date('d/m/Y',strtotime($c->data_nascimento))}}</td>
										<td>{{$c->rg}}</td>
										<td>{{$c->cpf}}</td>
										@if($navbar=='administrador')
											<td><a href='/administrador/paciente/editar/{{$c->usuario_id}}' class='btn btn-warning btn-sm' data-toggle='tooltip' title='Editar'><i class="fa fa-pen text-white"></i></a></td>
											<td><a href='/administrador/paciente/visualizar/{{$c->usuario_id}}' class='btn btn-info btn-sm' data-toggle='tooltip' title='Visualizar'><span class='fa fa-eye'></span></a></td>
										@else
											<td><a href='/clinica/paciente/editar/{{$c->usuario_id}}' class='btn btn-warning btn-sm' data-toggle='tooltip' title='Editar'><i class="fa fa-pen text-white"></i></a></td>
											<td><a href='/clinica/paciente/visualizar/{{$c->usuario_id}}' class='btn btn-info btn-sm' data-toggle='tooltip' title='Visualizar'><span class='fa fa-eye'></span></a></td>
										@endif
									</tr>
								@endforeach
								</tbody>
							</table>
							@include('_nav_paginacao')
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection