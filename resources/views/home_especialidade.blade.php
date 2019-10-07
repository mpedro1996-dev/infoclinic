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
        @foreach($especialidades as $key=>$e)
            <div class="py-4">
                <h1>{{$e->nome}}</h1>
                <p>{{$e->descricao}}</p>
            </div>
            @if($key!=(count($especialidades)-1))
                <hr>
            @endif
        @endforeach

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
