@extends('principal')
@section('content')
	@include('_navbar-medico')
	<div class="container-fluid">
		<div class="py-4">
			<div class="row justify-content-center">
				<div class="col-md-8">
					@include('erros')
					@include('mensagens')
					<center><h2>Cadastro de Dia de Atendimento</h2></center>
					<div class="card">
						<div class="card-header bg-success text-white"><i class="far fa-calendar-alt"></i> Dados do Dia de Atendimento</div>
						<div class="card-body">

							<form action="/medico/dias-atendimento/novo" method="POST" class="form-horizontal">
								@csrf
								<input type="hidden" name="vinculo_id" value="{{$idVinculo}}">
								@if(isset($id))
									<input type="hidden" name="id" value="{{$id}}">
								@endif
								<div class="form-group row">
									<label class="col-form-label text-md-right col-md-3" for="estado">Dia da Semana</label>
									<div class="col-md-2">
										<select name="dia_semana" class="form-control">
											@foreach($diasSemanas as $d)
												<option value="{{$d['valor']}}" @if(isset($diaAtendimento)){{$diaAtendimento->dia_semana==$d['valor']?'selected':''}}@endif>{{$d['descricao']}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-form-label text-md-right col-md-3" for="horario_inicio">Horario Inicio de Atendimento</label>
									<div class="col-md-2">
										<select name="horario_inicio" class="form-control">
											@foreach($comboxHorario as $horario)
												<option value="{{$horario}}" @if(isset($horarioInicio)){{$horarioInicio==$horario?'selected':''}}@endif>{{$horario}}</option>
											@endforeach
										</select>
									</div>

								</div>
								<div class="form-group row">
									<label class="col-form-label text-md-right col-md-3" for="horario_fim">Horario Fim de Atendimento</label>
									<div class="col-md-2">

										<select name="horario_fim" class="form-control">
											@foreach($comboxHorario as $horario)
												<option value="{{$horario}}" @if(isset($horarioFim)){{$horarioFim==$horario?'selected':''}}@endif>{{$horario}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group row">
									<div class="ml-auto col-md-9">
										<button type="submit" class="btn btn-success">Salvar</button>
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