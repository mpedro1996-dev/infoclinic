@extends('principal')
@section('content')
    @include('_navbar-'.$navbar)
    <div class="container-fluid">
        <div class="py-4">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-info text-white"><span class="fa fa-search"></span> Procurar</div>
                        <div class=card-body>
                            <form method="GET" action="{{$navbar=='clinica'?'/clinica/atendente/listar':'/administrador/atendente/listar'}}" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-md-right">{{$labelConsulta}}</label>
                                    <div class="col-md-9">
                                        <input name="consulta" type="text" maxlength="14" id="cpf_busca" class="form-control">
                                    </div>
                                </div>
                                @include('_form-consulta')
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-primary text-white"><span class="fa fa-list"></span> Listagem dos Atendentes</div>
                        <div class="card-body">
                            @include('mensagens')
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="thead-dark">
                                <tr>
                                    <th>ID de Atendente</th>
                                    <th>Nome</th>
                                    <th>Data de Nascimento</th>
                                    <th>CPF</th>
                                    <th>Clínica</th>
                                    <th colspan="3">Ação</th>
                                </tr>
                                </thead>
                                <tbody id="tabela-corpo">
                                @foreach($collection as $c)
                                    <tr>
                                        <td>{{$c->atendente_id}}</td>
                                        <td>{{$c->nome}}</td>
                                        <td>{{date('d/m/Y',strtotime($c->data_nascimento))}}</td>
                                        <td>{{$c->cpf}}</td>
                                        <td>{{$c->razao_social}}</td>
                                        @if($c->bloqueado==0)
                                            <td><a href="/atendente/mudar-status/{{$c->atendente_id}}" class='btn btn-danger btn-sm' data-toggle='tooltip' title='Bloquear'><span class='fa fa-ban'></span></a></td>
                                        @else
                                            <td><a href="/atendente/mudar-status/{{$c->atendente_id}}" class='btn btn-primary btn-sm' data-toggle='tooltip' title='Desbloquear'><span class='fa fa-check-circle'></span></a></td>
                                        @endif
                                        @if($navbar=="administrador")
                                            <td><a href='/administrador/atendente/editar/{{$c->usuario_id}}' class='btn btn-warning btn-sm' data-toggle='tooltip' title='Editar'><i class="fa fa-pen text-white"></i></a></td>
                                            <td><a href='/administrador/atendente/visualizar/{{$c->usuario_id}}' class='btn btn-info btn-sm' data-toggle='tooltip' title='Visualizar'><span class='fa fa-eye'></span></a></td>
                                        @else
                                            <td><a href='/clinica/atendente/editar/{{$c->usuario_id}}' class='btn btn-warning btn-sm' data-toggle='tooltip' title='Editar'><i class="fa fa-pen text-white"></i></a></td>
                                            <td><a href='/clinica/atendente/visualizar/{{$c->usuario_id}}' class='btn btn-info btn-sm' data-toggle='tooltip' title='Visualizar'><span class='fa fa-eye'></span></a></td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @include('_nav_paginacao')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
