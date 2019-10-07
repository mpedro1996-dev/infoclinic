@extends('principal')
@section('content')
	@include('_navbar-paciente')
	<div class="container-fluid">
		<div class="py-4">
			<div class="row justify-content-center">
				<div class="col-md-8">
					@include('erros')
					@include('mensagens')
					<center><h2>Anexo de Exames</h2></center>
					<div class="card">
						<div class="card-header bg-danger text-white"><i class="fas fa-file-medical-alt"></i> Dados do Exame</div>
						<div class="card-body">

							<form action="/paciente/exames/novo" method="POST" class="form-horizontal" enctype="multipart/form-data">
								@csrf
								<div class="form-group row">
									<label class="col-form-label text-md-right col-md-3" for="descricao">Descrição</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="descricao">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-form-label text-md-right col-md-3" for="nome_arquivo">Anexar arquivo do exame</label>
									<div class="col-md-6">
										<input type="file" class="form-control-file" name="arquivo" >
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
@endsection