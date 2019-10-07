@extends('principal')
@section('content')
	@include('_navbar-medico')
	<div class="container-fluid">
		<div class="py-4">
			<div class="row justify-content-center">
				<div class="col-md-4">
					<div class="card">
						<div class="card-header bg-info text-white"><span class="fa fa-search"></span> Procurar</div>
						<div class=card-body>
							<form method="GET" action="/medico/conselhos-regionais" class="form-horizontal">
								@include('_form-consulta')
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="card">
						<div class="card-header bg-primary text-white"><i class="fa fa-id-card-alt"></i> Meus Registros Regionais</div>
						<div class="card-body">
							@include('erros')
							@include('mensagens')
							<table class="table table-striped table-bordered" id="tabela-registros">
								<thead class="thead-dark">
								<th>Estado</th>
								<th>Tipo</th>
								<th>Número</th>
								<th>Ações</th>
								</thead>
								<tbody>
								@foreach($collection as $c)
									<tr>
										<td>{{$c->estado->uf}}</td>
										<td>{{$c->tipo_registro}}</td>
										<td>{{$c->numero}}</td>
										<td>
											@if($c->bloqueado==0)
												<a href="/medico/conselhos-regionais/mudar-status/{{$c->id}}" class="btn btn-danger" data-toggle='tooltip' title='Bloquear'><span class="fa fa-ban"></span></a>
											@else
												<a href="/medico/conselhos-regionais/mudar-status/{{$c->id}}" class="btn btn-primary" data-toggle='tooltip' title='Desbloquear'><span class="fa fa-check-circle"></span></a>
											@endif
											<a href="#" class="btn btn-primary" data-id="{{$c->id}}" id="btn-especialidade" data-toggle="tooltip" title='Especialidades'><i class="fas fa-briefcase-medical"></i></a>
										</td>
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
		@include("modal-cadastrar-especialidades")
		<script src="{{asset("js/pages/lista-conselhos-regionais.js")}}"></script>
	</div>
@endsection