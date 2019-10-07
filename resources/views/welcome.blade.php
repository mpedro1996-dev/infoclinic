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

    <div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin-bottom: 0;">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{asset('img/carousel/img-carousel-2.png')}}" alt="First slide">

                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{asset('img/carousel/img-carousel-3.png')}}" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{asset('img/carousel/img-carousel-1.png')}}" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>


    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="marketing">
        <div id="nossos-recursos">
            <div class="jumbotron jumbotron-fluid bg-primary text-white">
                <div class="container">
                    <div class="pt-0 pb-4">
                        <h1>Nossos Recursos</h1>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="text-md-center">
                                <span class="fa fa-user-md fa-9x"></span>
                                <div class="py-4">
                                    <h2>Médicos</h2>
                                </div>
                            </div>
                            <p>Veja quais são os médicos cadastrados em nosso sistema.</p>
                            <p><a class="btn btn-secondary" href="/nossos-medicos" role="button">Saiba mais &raquo;</a></p>

                        </div><!-- /.col-lg-4 -->
                        <div class="col-lg-4">
                            <div class="text-md-center">
                                <span class="fa fa-bookmark fa-9x"></span>
                                <div class="py-4">
                                    <h2>Especialidades</h2>
                                </div>
                            </div>
                            <p>Veja quais são as especialidades que nosso sistema abrange.</p>
                            <p><a class="btn btn-secondary" href="/nossas-especialidades" role="button">Saiba mais &raquo;</a></p>

                        </div><!-- /.col-lg-4 -->
                        <div class="col-lg-4">
                            <div class="text-md-center">
                                <span class="fas fa-hospital fa-9x"></span>
                                <div class="py-4">
                                    <h2>Clínicas</h2>
                                </div>
                            </div>
                            <p>Veja quais são as clinicas que estão cadastrada no nosso sistema.</p>
                            <p><a class="btn btn-secondary" href="/nossas-clinicas" role="button">Saiba mais &raquo;</a></p>
                        </div><!-- /.col-lg-4 -->
                    </div><!-- /.row -->
                </div>

            </div>
        </div>

        <!-- START THE FEATURETTES -->


        <div id="oque-oferecemos">
            <div class="container">
                <div class="py-4">
                    <h1>O que oferecemos</h1>
                </div>
            </div>
            <div class="py-4">
                <div class="container-fluid">
                    <div class="container">
                        <div class="row featurette">
                            <div class="col-md-7">
                                <h3 class="featurette-heading">Agendamento Online de Consultas</h3>
                                <p class="lead">Agende suas consultas no sistema.</p>
                            </div>
                            <div class="col-md-5">
                                <span class="fas fa-book fa-9x"></span>
                            </div>
                        </div>
                    </div>
                    <div class="py-4">
                        <hr class="featurette-divider">
                    </div>

                    <div class="container">
                        <div class="row featurette">
                            <div class="col-md-7 order-md-2">
                                <h3 class="featurette-heading">Prontuário Unificado</h3>
                                <p class="lead">Prontuário unificado e compartilhado em clínicas do sistema.</p>
                            </div>
                            <div class=" col-md-5 order-md-1">
                                <div class="text-md-center">
                                    <span class="fas fa-notes-medical fa-9x"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="py-4">
                        <hr class="featurette-divider">
                    </div>
                    <div class="container">
                        <div class="row featurette">
                            <div class="col-md-7">
                                <h3 class="featurette-heading">Segurança do Prontuário</h3>
                                <p class="lead">Segurança e sigilo médico-paciente garantido.</p>
                            </div>
                            <div class="col-md-5">
                                <span class="fa fa-lock fa-9x"></span>
                            </div>
                        </div>
                    </div>


                    <!-- /END THE FEATURETTES -->

                </div><!-- /.container -->
            </div>
        </div>



        <!-- FOOTER -->
    </div>
    <footer class="jumbotron jumbotron-fluid text-white" id="footer-home" style="background-color: #0A246A; ">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <p>&copy; 2018 InfoClinic.</p>
                </div>
                <div class="col-md-6">
                    <h3>Contato:</h3>
                    <p>atendimento@infoclinic.com.br</p>
                    <p>(24)99982-5200</p>
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
