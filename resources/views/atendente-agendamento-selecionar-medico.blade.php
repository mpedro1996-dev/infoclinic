@extends('principal')
@section('content')
    @include('_navbar-atendente')
    <?php $perfil="atendente"?>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="py-4">
                    @include('erros')
                    @include('mensagens')
                    <div class="card">
                        <div class="card-header bg-primary text-white">Escolha o medico</div>
                        <div class="card-body">
                            <input type="hidden" name="paciente_id" value="{{$paciente->id}}">
                            <input type="hidden" name="especialidade_id" value="{{$especialidade}}">
                            <table class="table table-hover table-bordered table-striped">
                                <thead class="thead-dark">
                                <th>Nome do Especialista</th>
                                <th>Genero do Especialista</th>
                                <th>Tipo de Registro</th>
                                <th>Numero do Registro</th>
                                <th>Estado do Registro</th>
                                <th>Ações</th>
                                </thead>
                                <tbody id="tbody-medico">
                                    @foreach($vinculos as $v)
                                        <tr>
                                            <td>{{$v->nome_medico}}</td>
                                            <td>{{$v->sexo}}</td>
                                            <td>{{$v->tipo_registro}}</td>
                                            <td>{{$v->numero}}</td>
                                            <td>{{$v->estado}}</td>
                                            <td>
                                                <form action="/atendente/agendamento/selecionar-horario" method="post">
                                                    @csrf
                                                    <input type="hidden" name="paciente_id" value="{{$paciente->id}}">
                                                    <input type="hidden" name="especialidade_id" value="{{$especialidade}}">
                                                    <input type="hidden" name="vinculo_id" value="{{$v->id}}">
                                                    <button type="submit" class="btn btn-primary" title="Selecionar" data-toggle="tooltip"><i class="fa fa-check"></i></button>

                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
