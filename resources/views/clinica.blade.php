@extends('principal')
@section('content')
	@include('_navbar-clinica')
    <?php $perfil="clinica"?>
	<div class="container-fluid">
		<div class="py-4">
			<div class="row justify-content-center">
				<div class="col-md-4">
					@include('_nav-dados-usuario')
					<div class="py-4">
						@include('_nav-perfis')
					</div>
				</div>
				<div class="col-md-8">
					<div class="card">
						<div class="card-header bg-primary text-white"><i class="fas fa-tachometer-alt"></i> Painel de Controle</div>
						<div class="card-body">
							<div class="py-4">
								@include('mensagens')
								<h1>Últimos vínculos cadastrados</h1>
								<div class="py-4">
									<div class="row">
										@if(count($vinculos)>0)
											@foreach($vinculos as $v)
												<div class="col-md-4">
													<div class="card text-white bg-secondary">
														<div class="card-header">{{$v->registroRegional->medico->usuario->nome}}</div>
														<div class="card-body">
															<p>Registro Vinculado: {{$v->registroRegional->tipo_registro}} - {{$v->registroRegional->numero}}, {{$v->registroRegional->estado->uf}}</p>
															<h4>Especialidades do vínculo</h4>
															@if(count($v->registroEspecialidades)>0)
																<ul>
																	@foreach($v->registroEspecialidades as $e)
																		<li>{{$e->especialidade->nome}}</li>
																	@endforeach
																</ul>

															@else
																<h5>Nenhuma especialidade vinculada</h5>
															@endif

														</div>
													</div>
												</div>
											@endforeach
										@else
											<div class="row">
												<div class="col-md-12">
													<h4>Nenhum vínculo cadastrado.</h4>
												</div>
											</div>
										@endif
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
