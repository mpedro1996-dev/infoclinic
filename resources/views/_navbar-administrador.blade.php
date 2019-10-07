<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #516e8e">
	<div class="container-fluid">
		<a class="navbar-brand" href="/administrador">
			<i class="fa fa-user-tie"></i> Administrador
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<!-- Left Side Of Navbar -->
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="/">Home</a>
				</li>
				@if(Auth::user()->administrador->permissao_especial!=0)
				<li class="nav-item dropdown active">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-tie"></i> Administradores <span class="caret"></span></a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="/administrador/novo"><i class="fa fa-plus"></i> Novo</a>
						<a class="dropdown-item" href="/administrador/listar"><i class="fa fa-list"></i> Procurar</a>
					</div>
				</li>
				@endif
				<li class="nav-item dropdown active">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="far fa-hospital"></i> Clínicas <span class="caret"></span></a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="/clinica/novo"><i class="fa fa-plus"></i> Novo</a>
						<a class="dropdown-item" href="/clinica/listar"><i class="fa fa-list"></i> Procurar</a>
					</div>
				</li>
				<li class="nav-item dropdown active">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-id-badge"></i> Atendentes <span class="caret"></span></a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="/administrador/atendente/novo"><i class="fa fa-plus"></i> Novo</a>
						<a class="dropdown-item" href="/administrador/atendente/listar"><i class="fa fa-list"></i> Procurar</a>
					</div>
				</li>
				<li class="nav-item dropdown active">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-md"></i> Médicos <span class="caret"></span></a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="/administrador/medico/novo"><i class="fa fa-plus"></i> Novo</a>
						<a class="dropdown-item" href="/administrador/medico/listar"><i class="fa fa-list"></i> Procurar</a>
					</div>
				</li>
				<li class="nav-item dropdown active">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i> Pacientes <span class="caret"></span></a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="/administrador/paciente/listar"><i class="fa fa-list"></i> Procurar</a>
					</div>
				</li>

			</ul>

			<!-- Right Side Of Navbar -->
			<ul class="navbar-nav ml-auto">
				<!-- Authentication Links -->
				@guest
					<li class="nav-item active">
						<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="{{ route('register') }}">{{ __('Registrar') }}</a>
					</li>
				@else
					<li class="nav-item active">
						<a class="nav-link" href="/administrador/pre-cadastro"><i class="fas fa-user-circle"></i> Atribuir Perfil</a>
					</li>
					<li class="nav-item dropdown active">
						<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
							{{ Auth::user()->nome }} <span class="caret"></span>
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="{{ route('logout') }}"
							   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
								{{ __('Sair') }}
							</a>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</div>
					</li>
				@endguest
			</ul>
		</div>
	</div>
</nav>