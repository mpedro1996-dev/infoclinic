@extends('principal')
@section('content')
    @include('_navbar-'.$navbar);
    <?php $perfil="administrador"?>
    <script>
        $(document).ready(function () {
            $('#link-endereco').click(function (event) {
                event.preventDefault();
                $(this).addClass("active");
                $('#link-credenciais').removeClass("active");
                $('#body-trabalho').slideUp(100);
                $('#body-endereco').slideDown();
            });
            $('#link-trabalho').click(function (event) {
                event.preventDefault();
                $(this).addClass("active");
                $('#link-endereco').removeClass("active");
                $('#body-endereco').slideUp(100);
                $('#body-trabalho').slideDown();
            });

        });
    </script>
    <div class="container-fluid">
        <div class="py-4">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <center><h2>Cadastro de Atendente</h2></center>
                    <div class="novo-administrador">
                        @include('erros')
                        <form class="form-horizontal" role="form" method="POST" action="/{{$navbar}}/atendente/novo">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="ultimaRequest" value="{{$path}}">
                            <div class="card">
                                <div class="card-header"><span class="fa fa-user"></span> Dados Pessoais</div>
                                <div class="card-body">
                                    @include('dados-pessoais-form')
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">
                                            E-Mail:
                                        </label>
                                        <div class="col-md-6">
                                            <input type="email" name="email" value="{{old('email')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="py-4">
                                <div class="card">
                                    <div class="card-header">
                                        <ul class="nav nav-tabs card-header-tabs">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="link-endereco" href="#"><i class="fa fa-map-marker-alt"></i> Endereço</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="link-trabalho" href="#"><i class="fas fa-id-badge"></i> Trabalho</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body" id="body-endereco" style="display: block">
                                        @include('_endereco-form')
                                    </div>
                                    <div class="card-body" id="body-trabalho">
                                        <div class="form-group row" >
                                            <label class="col-md-4 col-form-label text-md-right">Clínica</label>
                                            <div class="col-md-5">
                                                <select name="clinica_id" class="form-control">
                                                    @foreach($clinicas as $c)
                                                        <option value="{{$c->id}}">{{$c->razao_social}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="ml-auto col-md-8">
                                                <p>Um dos dois campos abaixo deve ser preenchido:</p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label text-md-right">Carteira</label>
                                            <div class="col-md-6">
                                                <input type="text" name="carteira" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label text-md-right">CNPJ</label>
                                            <div class="col-md-3">
                                                <input type="text" name="cnpj" maxlength="18" id="cnpj_busca" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-8 ml-auto">
                                                <button type="submit" class="btn btn-primary">
                                                    Enviar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection