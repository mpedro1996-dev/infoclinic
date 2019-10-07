@extends('principal')
@section('content')
    <script>
        $(document).ready(function () {
            $('#tabela-paciente-encontrado').fadeIn(600);
            $('#botao-permitir-clinica').click(function(event) {
                event.preventDefault();
                $('#atribuicao-clinica').hide();
                $('#atribuicao-atendente').hide();
                $('#atribuicao').slideDown();
                $('#atribuicao-clinica').fadeIn('slow');
            });
            $('#botao-permitir-atendente').click(function(event) {
                event.preventDefault();
                $('#atribuicao-clinica').hide();
                $('#atribuicao-atendente').hide();
                $('#atribuicao').slideDown();
                $('#atribuicao-atendente').fadeIn('slow');
            });
        });
    </script>
    @include('_navbar-'.$navbar)
    <div class="container-fluid">
        <div class="py-4">
            <div class="row justify-content-center">
                <div class="col-md-offset-2 col-md-8">
                    @include('erros')
                    @include('mensagens')
                    <div class="card">
                        <div class="card-header"><span class="glyphicon glyphicon-search"></span> Verificação de CPF existente</div>
                        <div class="card-body">
                            <form action="/pre-cadastro" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="ultimaRequest" value="{{$path}}">
                                <div class="form-group row">
                                    <label for="cpf" class="col-md-4 col-form-label text-md-right">CPF:</label>
                                    <div class="col-md-3">
                                        <input type="text" maxlength="14" id="cpf_busca" name="cpf" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" id="procurar" class="btn btn-primary" data-toggle="tooltip" title="Procurar"><span class="fa fa-search"></span> </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @if(session('paciente'))
                        <div class="py-4">
                            <div id="tabela-paciente-encontrado" class="card">
                                <div class="card-header">Paciente Encontrado</div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead class="thead-dark">
                                        <th>CPF:</th>
                                        <th>Nome:</th>
                                        <th>Data de Nascimento:</th>
                                        <th colspan="4">Ações</th>
                                        </thead>
                                        <tbody>
                                        <td>{{session('paciente')->cpf}}</td>
                                        <td>{{session('paciente')->usuario->nome}}</td>
                                        <td>{{date('d/m/Y',strtotime(session('paciente')->usuario->data_nascimento))}}</td>
                                        <td>
                                            @if((Auth::user()->administrador_id!=null&&Auth::user()->administrador->permissao_especial==1)&&session('paciente')->usuario->administrador_id==null)
                                                <a href="/administrador/permitir/{{session('paciente')->usuario->id}}" class="btn btn-primary" id="botao-permitir-administrador" data-toggle="tooltip" title="Administrador"><i class="fas fa-link"></i></a>
                                            @endif
                                            @if(Auth::user()->administrador_id!=null&&session('paciente')->usuario->clinica_id==null)
                                                <a href="#" class="btn btn-primary" id="botao-permitir-clinica" data-toggle="tooltip" title="Clínica"><i class="fas fa-link"></i></a>
                                            @endif
                                            @if((Auth::user()->clinica_id!=null||Auth::user()->administrador_id!=null)&&session('paciente')->usuario->atendente_id==null)
                                                <a href="#" class="btn btn-primary" id="botao-permitir-atendente" data-toggle="tooltip" title="Atendente"><i class="fas fa-link"></i></a>
                                            @endif
                                            @if((Auth::user()->clinica_id!=null||Auth::user()->administrador_id!=null)&&session('paciente')->usuario->medico_id==null)

                                                <a href="/{{$navbar}}/medico/permitir/{{session('paciente')->usuario->id}}" class="btn btn-primary" id="botao-permitir-medico" data-toggle="tooltip" title="Médico"><i class="fas fa-link"></i></a>

                                            @endif
                                        </td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card" id="atribuicao">
                            <div class="card-header">Dados para atribuição de perfil desejado</div>
                            <div class="card-body">
                                <div class="form-horizontal">
                                    <form method="post" action="/clinica/permitir" id="atribuicao-clinica">
                                        <input type="hidden" id="usuario-id" name="usuario-id" value="{{session('paciente')->usuario->id}}">
                                        <input type="hidden" name="administrador_id" value="{{Auth::user()->administrador_id}}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="form-group row" >
                                            <label class="col-md-4 col-form-label text-md-right">CNPJ:</label>
                                            <div class="col-md-3">
                                                <input type="text" id="cnpj" maxlength="18" name="cnpj" class="form-control" value="{{old('cnpj')}}">
                                            </div>
                                        </div>
                                        <div class="form-group row" >
                                            <label class="col-md-4 col-form-label text-md-right">Razão Social:</label>
                                            <div class="col-md-8">
                                                <input type="text" name="razao_social" class="form-control" value="{{old('razao_social')}}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8 ml-auto">
                                                <button type="submit" id="atribuir-medico" class="btn btn-primary">Enviar</button>
                                            </div>
                                        </div>
                                    </form>
                                    <form method="post" action="/{{$navbar}}/atendente/permitir" id="atribuicao-atendente">
                                        <input type="hidden" id="usuario-id" name="usuario-id" value="{{session('paciente')->usuario->id}}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="form-group row" >
                                            <label class="col-md-4 col-form-label text-md-right">Clínica:</label>
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
                                            <label class="col-md-4 col-form-label text-md-right">Carteira:</label>
                                            <div class="col-md-5">
                                                <input type="text" name="carteira" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label text-md-right">CNPJ:</label>
                                            <div class="col-md-3">
                                                <input type="text" name="cnpj" maxlength="18" id="cnpj_busca" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-4 ml-auto">
                                                <button type="submit" id="atribuir-medico" class="btn btn-primary">Enviar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection