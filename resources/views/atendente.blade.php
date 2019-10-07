@extends('principal')
@section('content')
	@include('_navbar-atendente')
    <?php $perfil="atendente"?>
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
                                <h1>Primeiras consultas do dia</h1>
                                <div class="py-4">
                                    <div class="row">
                                        @if(count($consultas)>0)
                                            @foreach($consultas as $c)
                                                <div class="col-md-4">
                                                    <div class="card text-white bg-secondary">
                                                        <div class="card-header">{{$c->agendamento->vinculo->registroRegional->medico->usuario->nome}}</div>
                                                        <div class="card-body">
															<p><b>Data de Agendamento:</b> {{date('d/m/Y H:i',strtotime($c->agendamento->data_agendamento))}}</p>
															<p><b>Especialidade:</b> {{$c->especialidade->nome}}</p>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4>Nenhuma consulta cadastrada.</h4>
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
