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
							<form method="GET" action="/paciente/exames/listar" class="form-horizontal">
								<div class="form-group row">
									<label class="col-md-3 col-form-label text-md-right">{{$labelConsulta}}</label>
									<div class="col-md-9">
										<input name="consulta" type="text" class="form-control">
									</div>
								</div>
								@include('_form-consulta')
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="card">
						<div class="card-header bg-primary text-white"><i class="fa fa-list"></i> Listagem dos Exames Anexados</div>
						<div class="card-body">
							@include('mensagens')
							<table class="table table-bordered table-striped table-hover">
								<thead class="thead-dark">
								<tr>
									<th>Descrição</th>
									<th>Data de Criação</th>
									<th colspan="3">Ações</th>
								</tr>
								</thead>
								<tbody id="tabela-corpo">
								@if(count($collection)>0)
								@foreach($collection as $c)
									<tr>
										<td>{{$c->descricao}}</td>
										<td>{{date('d/m/Y',strtotime($c->created_at))}}</td>
										<td>
											@if($c->bloqueado==0)
												<a href='/paciente/exames/mudar-status/{{$c->id_prontuario}}' class='btn btn-danger btn-sm' data-toggle='tooltip' title='Bloquear'><span class='fa fa-ban'></span></a>
											@else
												<a href='/paciente/exames/mudar-status/{{$c->id_prontuario}}' class='btn btn-primary btn-sm' data-toggle='tooltip' title='Desbloquear'><span class='fa fa-check-circle'></span></a>
											@endif
										</td>
										@if($c->nome_arquivo != null)
											<td><a href='{{url(Storage::url('public/exames/'.$c->nome_arquivo))}}' target="_new" class='btn btn-dark btn-sm' data-toggle='tooltip' title='Baixar Anexo'><i class="fas fa-file"></i></a></td>
										@else
											<td><a href='#' target="_new" class='btn btn-dark btn-sm' data-toggle='tooltip' title='Não tem anexo' onclick="desabilitar(event)"><i class="fa fa-info text-white"></i></a></td>
										@endif
										<td><a href='/paciente/exames/excluir/{{$c->id_exame}}' class='btn btn-info btn-sm' data-toggle='tooltip' title='Excluir'><span class='fa fa-trash'></span></a></td>
									</tr>
								@endforeach
									@else
									<tr>
										<td colspan="3">Não há dados para serem exibidos</td>
									</tr>
									@endif
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