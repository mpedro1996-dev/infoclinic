@extends('principal')
@section('content')
	@include('_navbar-administrador')
    <?php $perfil="administrador"?>
	<div class="container-fluid">
		<div class="py-4">
			<div class="row justify-content-center">
				<div class="col-md-8">
					<center><h2>Cadastro de Administrador</h2></center>
					<div class="novo-administrador">
					</div>
					@include('erros')
					<form class="form-horizontal" role="form" method="POST" action="/administrador/novo">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="card ">
							<div class="card-header">
								<span class="fa fa-user"></span> Dados Pessoais
							</div>
							<div class="card-body">
								@include('dados-pessoais-form')
								<div class="form-group row">
									<label class="col-md-4 col-form-label text-md-right">
										E-Mail
									</label>
									<div class="col-md-6">
										<input type="email" name="email" value="{{old('email')}}" class="form-control">
									</div>
								</div>
							</div>
						</div>
						<div class="py-4">
							<div class="card ">
								<div class="card-header"><i class="fa fa-map-marker-alt"></i> Endereço</div>
								<div class="card-body">
									@include('_endereco-form')
									<div class="form-group row">
										<div class="col-md-8 ml-auto">
											<button type="submit" class="btn btn-primary">
												Enviar
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection