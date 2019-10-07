<!doctype html>
<html lang="{{app()->getLocale()}}">
@include("_imports")
<body>
<style>
    .jumbotron{
        margin-bottom: 0;
    }
</style>

<header>
    @include("_navbar-home")
</header>


<main role="main">
    <div class="container">
        @if(count($medicos)>0)
            @foreach($medicos as $key=>$m)
                <div class="py-4">
                    <h1>{{$m->usuario->nome}}</h1>
                    @if(count($m->registroRegional)>0)
                        <h4>Conselhos Regionais dos Médicos</h4>
                        <ul>
                            @foreach($m->registroRegional as $r)
                                <li>{{$r->numero}} - {{$r->estado->nome}}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                @if($key!=(count($medicos)-1))
                    <hr>
                @endif
            @endforeach
        @else
            <div class="py-4" style="height: 750px;">
                <h1>Nenhum Médico cadastrado</h1>
            </div>
        @endif

    </div>

    <footer class="jumbotron jumbotron-fluid text-white" id="footer-home" style="background-color: #0A246A; ">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <p>&copy; 2018 InfoClinic.</p>
                </div>
                <div class="ml-auto col-md-2">
                    <div class="d-flex justify-content-start">
                        <div class="p-2"><i class="fab fa-facebook-square fa-2x"></i></div>
                        <div class="p-2"><i class="fab fa-instagram fa-2x"></i></div>
                        <div class="p-2"><i class="fab fa-whatsapp fa-2x"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    </div>
</main>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
@include("_scripts")
</body>
</html>
