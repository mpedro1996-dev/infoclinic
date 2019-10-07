@extends('principal')
@section('content')
	@include('_navbar-medico')
	<div class="container-fluid">
		<div class="py-4">
			<div class="row justify-content-center">
				<div class="col-md-8">
					@include('erros')
					@include('mensagens')
					<div class="card">
						<div class="card-header bg-success text-white"><i class="fa fa-id-card-alt"></i> Dados do Registro Regional</div>
						<div class="card-body">
							<form action="/medico/conselhos-regionais" method="POST" class="form-horizontal">
								@csrf
								<input type="hidden" name="medico_id" value="{{Auth::user()->medico->id}}">
								<div class="form-group row">
									<label class="col-form-label text-md-right col-md-3" for="estado">Estado</label>
									<div class="col-md-2">
										<select name="estado_id" class="form-control">
											@foreach($estados as $e)
												<option value="{{$e->id}}">{{$e->uf}}</option>
											@endforeach
										</select>
									</div>
									<label class="col-form-label text-md-right col-md-1" for="numero">Número</label>
									<div class="col-md-3">
										<input name="numero" type="text" class="form-control" value="{{old('numero')}}">
									</div>
									<label class="col-form-label text-md-right col-md-1" for="tipo_registro">Tipo</label>
									<div class="col-md-2">
										<input name="tipo_registro" type="text" maxlength="3" class="form-control" value="{{old('tipo_registro')}}">
										<small class="text-muted">
											Ex:CRM,CRN,CRO,...
										</small>
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