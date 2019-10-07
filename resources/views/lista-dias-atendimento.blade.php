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
                            <form method="GET" action="/medico/dias-atendimento/listar" class="form-horizontal">
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
                        <div class="card-header bg-primary text-white"><i class="fa fa-list"></i> Listagem de Dias de Atendimento </div>
                        <div class="card-body">
                            @include('erros')
                            @include('mensagens')
                            <table class="table table-striped table-bordered table-hover">
                                <thead class="thead-dark">
                                <th>Clínica</th>
                                <th>Dia da Semana</th>
                                <th>Horario Inicial</th>
                                <th>Horario Final</th>
                                <th colspan="2">Ações</th>
                                </thead>
                                <tbody>
                                @foreach($collection as $c)
                                    <tr>
                                        <td>{{$c->razao_social}}</td>
                                        <td>
                                            @if($c->dia_semana==0)
                                                Domingo
                                            @endif
                                            @if($c->dia_semana==1)
                                                Segunda-Feira
                                            @endif
                                            @if($c->dia_semana==2)
                                                Terça-Feira
                                            @endif
                                            @if($c->dia_semana==3)
                                                Quarta-Feira
                                            @endif
                                            @if($c->dia_semana==4)
                                                Quinta-Feira
                                            @endif
                                            @if($c->dia_semana==5)
                                                Sexta-Feira
                                            @endif
                                            @if($c->dia_semana==6)
                                                Sábado
                                            @endif
                                        </td>
                                        <td>{{date('H:i',strtotime($c->horario_inicio))}}h</td>
                                        <td>{{date('H:i',strtotime($c->horario_fim))}}h</td>
                                        <td>
                                            <a href="/medico/dias-atendimento/alterar/{{$c->id}}" class="btn btn-warning text-white" data-toggle='tooltip' title='Editar'><i class="fa fa-pen"></i></a>
                                        </td>
                                        <td>
                                            <a href="/medico/dias-atendimento/excluir/{{$c->id}}" class="btn btn-danger" data-toggle='tooltip' title='Excluir'><i class="far fa-calendar-times"></i></a>
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