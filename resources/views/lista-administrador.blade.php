@extends('principal')
@section('content')
	@include('_navbar-administrador')
	<div class	="container-fluid">
		<div class="py-4">
			<div class="row justify-content-center">
				<div class="col-md-4">
					<div class="card">
						<div class="card-header bg-info text-white"><i class="fa fa-search"></i> Procurar</div>
						<div class=card-body>
							<form method="GET" action="/administrador/listar" class="form-horizontal">
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
						<div class="card-header bg-primary text-white"><i class="fa fa-list"></i> Listagem dos Administradores</div>
						<div class="card-body">
							@include('mensagens')
							<table class="table table-bordered table-striped table-hover">
								<thead class="thead-dark">
								<tr>
									<th>ID de Administrador</th>
									<th>Nome</th>
									<th>Data de Nascimento</th>
									<th>RG</th>
									<th>CPF</th>
									<th colspan="3">Ação</th>
								</tr>
								</thead>
								<tbody id="tabela-corpo">
								@foreach($collection as $c)
									<tr>
										<td>{{$c->administrador_id}}</td>
										<td>{{$c->nome}}</td>
										<td>{{date('d/m/Y',strtotime($c->data_nascimento))}}</td>
										<td>{{$c->rg}}</td>
										<td>{{$c->cpf}}</td>
										<td>
											@if($c->bloqueado==0)
												<a href='/administrador/mudar-status/{{$c->administrador_id}}' class='btn btn-danger btn-sm' data-toggle='tooltip' title='Bloquear'><span class='fa fa-ban'></span></a>
											@else
												<a href='/administrador/mudar-status/{{$c->administrador_id}}' class='btn btn-primary btn-sm' data-toggle='tooltip' title='Desbloquear'><span class='fa fa-check-circle'></span></a>
											@endif
										</td>
										<td><a href='/administrador/editar/{{$c->usuario_id}}' class='btn btn-warning btn-sm' data-toggle='tooltip' title='Editar'><i class="fa fa-pen text-white"></i></a></td>
										<td><a href='/administrador/visualizar/{{$c->usuario_id}}' class='btn btn-info btn-sm' data-toggle='tooltip' title='Visualizar'><span class='fa fa-eye'></span></a></td>
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