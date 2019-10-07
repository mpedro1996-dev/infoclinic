<nav class="navbar navbar-expand-md navbar-dark bg-danger">
	<div class="container-fluid">
		<a class="navbar-brand" href="{{ url('/paciente') }}">
			<i class="fa fa-user"></i> Paciente
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
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-first-aid"></i> Consultas <span class="caret"></span></a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="/paciente/consulta/novo"><i class="fa fa-plus"></i> Novo</a>
						<a class="dropdown-item" href="/paciente/consultas/listar"><i class="fa fa-list"></i> Procurar</a>
					</div>
				</li>
				<li class="nav-item dropdown active">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-file-medical-alt"></i> Exames <span class="caret"></span></a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="/paciente/exames/novo"><i class="fa fa-plus"></i> Novo</a>
						<a class="dropdown-item" href="/paciente/exames/listar"><i class="fa fa-list"></i> Procurar</a>
					</div>
				</li>
				<li class="nav-item active">
					<a href="/paciente/prontuario/listar" class="nav-link"><i class="fas fa-notes-medical"></i> Prontuário</a>
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