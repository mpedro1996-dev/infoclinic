@extends('principal')
@section('content')
    @include('_navbar-atendente')
    <?php $perfil="atendente"?>
    <script src="{{asset('js/pages/nova-consulta-atendente.js')}}"></script>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="py-4">
                    @include('erros')
                    @include('mensagens')
                    <input type="hidden" id="paciente-id" value="{{$paciente}}">
                    <input type="hidden" id="especialidade-id" value="{{$especialidade}}">
                    <input type="hidden" id="vinculo-id" value="{{$vinculo}}">
                    <div class="card">
                        <div class="card-header bg-primary text-white">Escolha o horário</div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Selecione o Dia da Semana:</label>
                                    <div id="div-dias-semana"></div>
                                </div>
                            </div>
                            <div id="div-data-agendamento" style="display: none;">
                                <div class="form-group" >
                                    <div class="col-md-4">
                                        <label for="data-agendamento">Data de Agendamento:</label>
                                        <input type="text" id="data-agendamento" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div id="div-horario" style="display: none;">
                                <div class="form-group">
                                    <div class="col-md-2">
                                        <label for="horario-agendamento">Horário:</label>
                                        <select name="horario-agendamento" id="horario-agendamento" class="form-control"></select>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="invalid-feedback" id="erro-agendamento" style="display: none;">
                                            Escolha um horário para o agendamentos
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary" id="btn-agendar" >Agendar Consulta</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="dialog">
        <div data-role="body">
            Agendamento Cadastrado com Sucesso
        </div>
        <div data-role="footer">
            <button type="button" class="btn btn-primary" data-role="close">OK</button>
        </div>
    </div>
@endsection
