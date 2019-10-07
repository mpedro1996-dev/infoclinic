@extends('principal')
@section('content')
    @include('_navbar-medico')
    <div class="container-fluid">
        <div class="py-4">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-info text-white"><span class="fa fa-search"></span> Procurar</div>
                        <div class=card-body>
                            <form method="GET" action="/medicos/vinculos/listar" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-md-right">{{$labelConsulta}}</label>
                                    <div class="col-md-9">
                                        <input name="consulta" type="text" class="form-control">
                                    </div>
                                </div>
                                @include('_form-consulta')
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-default">
                        <div class="card-header bg-primary text-white"><i class="fa fa-list"></i> Listagem de Médicos Vinculados</div>
                        <div class="card-body">
                            @include('erros')
                            @include('mensagens')
                            <table class="table table-striped table-bordered table-hover">
                                <thead class="thead-dark">
                                <th>Nome do Médico</th>
                                <th>Estado</th>
                                <th>Número</th>
                                <th>Ações</th>
                                </thead>
                                <tbody>
                                @foreach($collection as $c)
                                    <tr>
                                        <td>{{$c->razao_social}}</td>
                                        <td>{{$c->uf}}</td>
                                        <td>{{$c->numero}}</td>
                                        <td>
                                            <a href="/medico/dias-atendimento/novo/{{$c->id}}" class="btn btn-primary" data-toggle='tooltip' title='Cadastrar Dia de Atendimento'><i class="far fa-calendar-plus"></i></a>
                                        </td>
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