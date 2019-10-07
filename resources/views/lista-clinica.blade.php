@extends('principal')
@section('content')
	@if(Auth::user()->administrador_id!=0&&Auth::user()->administrador->bloqueado==0)
		@include('_navbar-administrador')
		<div class="container-fluid">
			<div class="py-4">
				<div class="row justify-content-center">
					<div class="col-md-4">
						<div class="card card-info">
							<div class="card-header bg-info text-white"><i class="fa fa-search"></i> Procurar</div>
							<div class=card-body>
								<form method="GET" action="/clinica/listar" class="form-horizontal">
									<div class="form-group row">
										<label class="col-md-3 col-form-label text-md-right">{{$labelConsulta}}</label>
										<div class="col-md-9">
											<input name="consulta" type="text" maxlength="18" id="cnpj" class="form-control">
										</div>
									</div>
									@include('_form-consulta')
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="card">
							<div class="card-header bg-primary text-white"><i class="fa fa-list"></i> Listagem das Clínicas</div>
							<div class="card-body">
								@include('mensagens')
								<p><span class="badge badge-warning text-white">Atenção:</span> As linhas em azul, são registros nos quais você é responsável</p>
								<table class="table table-bordered table-striped table-hover">
									<thead class="thead-dark">
									<tr>
										<th>CNPJ</th>
										<th>Nome da Cliníca</th>
										<th>Data de Inaguração</th>
										<th>Data de Criação</th>
										<th colspan="3">Ação</th>
									</tr>
									</thead>
									<tbody id="tabela-corpo">
									@foreach($collection as $c)
										<tr class="{{$c->administrador_id==Auth::user()->administrador_id?'table-primary':''}}">
											<td>{{$c->cnpj}}</td>
											<td>{{$c->razao_social}}</td>
											<td>{{date('d/m/Y',strtotime($c->data_inauguracao))}}</td>
											<td>{{date('d/m/Y',strtotime($c->created_at))}}</td>
											<td>
												@if($c->bloqueado==0)
													<a href='/clinica/mudar-status/{{$c->clinica_id}}' class='btn btn-danger btn-sm' data-toggle='tooltip' title='Bloquear'><span class='fa fa-ban'></span></a>
												@else
													<a href='/clinica/mudar-status/{{$c->clinica_id}}' class='btn btn-primary btn-sm' data-toggle='tooltip' title='Desbloquear'><span class='fa fa-check-circle'></span></a>
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
	@else
		@include('acesso-negado')
	@endif
@endsection