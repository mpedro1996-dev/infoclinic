@extends('principal')
@section('content')
	@include('_navbar-medico')
	<div class="container-fluid">
		<div class="py-4">
			<div class="row justify-content-center">
				<div class="col-md-8">
					@include('erros')
					@include('mensagens')
					<center><h2>Consulta</h2></center>
					<form action="/medico/consultas/cadastrar" method="POST" class="form-horizontal">
						@csrf
						<input name="consulta_id" id="consulta_id" type="hidden" value="{{$consulta->id}}">
						<div class="card">
							<div class="card-header bg-success text-white"><i class="fa fa-user"></i> Dados do Paciente</div>
							<div class="card-body">
								<div class="row justify-content-center">
									<div class="col-md-9">
										<div class="form-group row">
											<label for="peso" class="col-form-label col-md-1 text-md-right">Peso</label>
											<div class="col-md-4">
												<input type="number" class="form-control" name="peso" value="{{$consulta->paciente->peso}}">
											</div>
											<label for="altura" class="col-form-label col-md-1 text-md-right" >Altura</label>
											<div class="col-md-4">
												<input type="number" class="form-control" name="altura" value="{{$consulta->paciente->altura}}">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="py-4">
							<div class="card">
								<div class="card-header bg-success text-white"><i class="fas fa-notes-medical"></i> Queixa Principal</div>
								<div class="card-body">
									<div class="row justify-content-center">
										<div class="col-md-9">
											<div class="form-group row">
												<textarea name="queixa_principal">{{old('queixa_principal')}}</textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="py-4">
							<div class="card">
								<div class="card-header bg-success text-white"><i class="fas fa-file-medical"></i> Principais Sintomas</div>
								<div class="card-body">
									<div class="row justify-content-center">
										<div class="col-md-9">
											<div class="form-group row">
												<textarea name="principais_sintomas">{{old('principais_sintomas')}}</textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="py-4">
							<div class="card">
								<div class="card-header bg-success text-white"><i class="fas fa-allergies"></i> Exame Físico</div>
								<div class="card-body">
									<div class="row justify-content-center">
										<div class="col-md-9">
											<div class="form-group row">
												<textarea name="exame_fisico">{{old('exame_fisico')}}</textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="py-4">
							<div class="card">
								<div class="card-header bg-success text-white"><i class="fas fa-diagnoses"></i> Hipótese Diagnóstica</div>
								<div class="card-body">
									<div class="row justify-content-center">
										<div class="col-md-9">
											<div class="form-group row">
												<textarea name="hipotese_diagnostica">{{old('hipotese_diagnostica')}}</textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="py-4">
							<div class="card">
								<div class="card-header bg-success text-white"><i class="fas fa-procedures"></i> Orientação</div>
								<div class="card-body">
									<div class="row justify-content-center">
										<div class="col-md-9">
											<div class="form-group">
												<textarea name="orientacao">{{old('orientacao')}}</textarea>
											</div>
											<div class="form-group row">
												<div class="col-md-6 ml-auto mr-auto">
													<div class="form-group form-check">
														<input type="checkbox" class="form-check-input" id="autorizacao" name="autorizacao">
														<label class="form-check-label" for="autorizacao" >Autorizo a visualização dessa consulta por outros médicos.</label>
													</div>
												</div>
											</div>
											<div class="form-group row">
												<div class="col-md-2 ml-auto">
													<a class="btn btn-danger" target="_new" href="/medico/prontuario/listar/{{$consulta->paciente->id}}"><i class="fas fa-notes-medical"></i> Prontuário</a>
												</div>
												<div class="col-md-2">
													<button type="button" class="btn btn-dark" id="btn-modal-prescricao"><i class="fas fa-prescription"></i> Prescrição</button>
												</div>
												<div class="col-md-2 mr-auto">
													<button type="submit" class="btn btn-primary">Fechar Consulta</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
					@include('modal-cadastrar-prescricao')
					<script src="{{asset("js/pages/modal-prescricao.js")}}"></script>
				</div>
			</div>
		</div>
	</div>
@endsection