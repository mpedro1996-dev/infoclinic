<div class="card">
	<div class="card-header text-white bg-info"><i class="fa fa-user"></i> Dados do Usuário</div>
	<div class="card-body">
		@if(Auth::user()->clinica_id!=null)
			<p><b>CNPJ:</b> {{Auth::user()->clinica->cnpj}}</p>
		@endif
		@if(Auth::user()->paciente_id!=null)
			<p><b>CPF:</b> {{Auth::user()->paciente->cpf}}</p>
		@endif
		<p><b>Nome:</b> {{Auth::user()->nome}}</p>
		@if(Auth::user()->atendente_id!=null)
			@if(Auth::user()->atendente->carteira!="")
				<p><b>Carteira de Trabalho:</b> {{Auth::user()->atendente->carteira}}</p>
			@endif
			@if(Auth::user()->atendente->cnpj!="")
				<p><b>CNPJ:</b> {{Auth::user()->atendente->cnpj}}</p>
			@endif
		@endif
		@if(Auth::user()->administrador_id!=null)
			<p><b>ID de Administrador:</b> {{Auth::user()->administrador_id}}</p>
		@endif
		<div class="row">
			<div class="col-md-3 ml-auto">
				@if($perfil!="")
					<a href="/<?=$perfil?>/editar/{{Auth::user()->id}}" class="btn btn-warning text-white" data-toggle="tooltip" title="Editar"><i class="fas fa-user-edit"></i></a>
				@else
					<a href="/editar/{{Auth::user()->id}}" class="btn btn-warning text-white" data-toggle="tooltip" title="Editar"><i class="fas fa-user-edit"></i></a>
				@endif

				@if($perfil!="")
					<a href="/<?=$perfil?>/visualizar/{{Auth::user()->id}}" class="btn btn-info" data-toggle="tooltip" title="Visualizar"><i class="far fa-eye"></i></a>
				@else
					<a href="/visualizar/{{Auth::user()->id}}" class="btn btn-info" data-toggle="tooltip" title="Visualizar"><i class="far fa-eye"></i></a>
				@endif
			</div>
		</div>
	</div>
</div>