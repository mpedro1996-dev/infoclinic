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
        @if(count($clinicas)>0)
            @foreach($clinicas as $key=>$c)
                <div class="py-4">
                    <h1>{{$c->razao_social}}</h1>
                    <p>{{$c->cidade_clinica}}, {{$c->estado_clinica}}</p>
                    {!!$c->descricao!!}

                </div>
                @if($key!=(count($clinicas)-1))
                    <hr>
                @endif
            @endforeach
        @else
            <div class="py-4" style="height: 750px;">
                <h1>Nenhuma Clínica cadastrada</h1>
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
