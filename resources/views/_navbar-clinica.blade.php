<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #00f">
	<div class="container-fluid">
		<a class="navbar-brand" href="/clinica">
            <i class="far fa-hospital"></i> Clínica
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
				<li class="nav-item dropdown active">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-id-badge"></i> Atendentes <span class="caret"></span></a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="/clinica/atendente/novo"><i class="fa fa-plus"></i> Novo</a>
						<a class="dropdown-item" href="/clinica/atendente/listar"><i class="fa fa-list"></i> Procurar</a>
					</div>
				</li>
				<li class="nav-item dropdown active">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-md"></i> Médicos <span class="caret"></span></a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="/clinica/medico/novo"><i class="fa fa-plus"></i> Novo</a>
						<a class="dropdown-item" href="/clinica/medico/listar"><i class="fa fa-list"></i> Procurar</a>
					</div>
				</li>
				<li class="nav-item dropdown active">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-link"></i> Conselhos Regionais <span class="caret"></span></a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="/clinica/medico/conselhos-regionais/listar"><i class="fa fa-id-card-alt"></i> Registros Regionais</a>
						<a class="dropdown-item" href="/clinica/vinculos/listar"><i class="fa fa-list"></i> Procurar</a>
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
						<a class="nav-link" href="/clinica/pre-cadastro"><i class="fas fa-user-circle"></i> Atribuir Perfil</a>
					</li>
					<li class="nav-item dropdown active">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
							{{ Auth::user()->nome }} <span class="caret"></span>
						</a>

						<div class="dropdown-menu" >
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