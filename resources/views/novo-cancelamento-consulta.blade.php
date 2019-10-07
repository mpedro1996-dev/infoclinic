@extends('principal')
@section('content')
	@include('_navbar-atendente')
	<div class="container-fluid">
		<div class="py-4">
			<div class="row justify-content-center">
				<div class="col-md-8">
					@include('erros')
					@include('mensagens')
					<center><h2>Cancelamento de Consulta</h2></center>
					<div class="card">
						<div class="card-header text-white" style="background-color:#666"><i class="fas fa-first-aid"></i> Dados da Consultas</div>
						<div class="card-body">
							<p><b>Nome da Paciente:</b> {{$consulta->paciente->usuario->nome}}</p>
							<p><b>Nome da Médico:</b> {{$consulta->agendamento->vinculo->registroRegional->medico->usuario->nome}}</p>
							<p><b>Especialidade:</b> {{$consulta->especialidade->nome}}</p>
							<p><b>Data de Agendamento:</b> {{date("d/m/Y H:i",strtotime($consulta->agendamento->data_agendamento))}}</p>
						</div>
					</div>
					<div class="py-4">
						<div class="card">
							<div class="card-header text-white" style="background-color:#666"><i class="fas fa-times"></i> Cancelamento</div>
							<div class="card-body">
								<form action="/atendente/consultas/salvar-cancelamento" method="POST" class="form-horizontal" enctype="multipart/form-data">
									@csrf
									<input type="hidden" name="id_consulta" value="{{$consulta->id}}">
									<div class="form-group row">
										<label class="col-form-label text-md-right col-md-3" for="descricao">Justificativa</label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="justificativa">
										</div>
									</div>

									<div class="form-group row">
										<div class="ml-auto col-md-9">
											<button type="submit" class="btn btn-primary">Salvar</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection