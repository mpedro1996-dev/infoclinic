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
                        <div class="card-header bg-primary text-white">Escolha o paciente</div>
                        <div class="card-body">
                            <form action="/atendente/agendamento/validar-paciente" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-form-label col-md-4 text-md-right">CPF</label>
                                    <div class="col-md-4">
                                        <input id="cpf" name="cpf" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-4 text-md-right">Especialidade</label>
                                    <div class="col-md-4">
                                        <select name="especialidade" class="form-control">
                                            @foreach($especialidades as $e)
                                                <option value="{{$e->id}}">{{$e->nome}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4 ml-auto mr-auto">
                                        <button type="submit" class="btn btn-primary">Procurar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
