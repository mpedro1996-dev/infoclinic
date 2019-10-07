<style>
    .nav-link{
        font-size: 24px;
    }
</style>
<nav class="navbar navbar-expand-md navbar-light bg-light">
    <a class="navbar-brand" href="{{ url('/') }}">
        <div class="text-center">
            <img src="{{asset("img/logo.png")}}" alt="Infoclinic" style="max-width: 200px">
            <h5>Compartilhando saúde com segurança</h5>
        </div>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">
            <div class="mr-2">
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/#nossos-recursos')}}">Nossos Recursos</a>
                </li>
            </div>
            <div class="mr-2">
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/#oque-oferecemos')}}">O que oferecemos</a>
                </li>
            </div>
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }} </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Registrar') }}</a>
            </li>

            @endguest
        </ul>
    </div>
</nav>
