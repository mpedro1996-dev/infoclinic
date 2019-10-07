<nav class="navbar navbar-expand-md navbar-dark bg-dark">
	<div class="container-fluid">
		<a class="navbar-brand" href="{{ url('/') }}">
			{{ config('app.name', 'Laravel') }}
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<!-- Left Side Of Navbar -->
			<ul class="navbar-nav mr-auto">

			</ul>

			<!-- Right Side Of Navbar -->
			<ul class="navbar-nav ml-auto">
				<!-- Authentication Links -->
				@guest
					<li class="nav-item active">
						<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }} </a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="{{ route('register') }}">{{ __('Registrar') }}</a>
					</li>
				@else
					<li class="nav-item dropdown active">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->nome }} <span class="caret"></span></a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
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