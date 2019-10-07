<div class="modal fade" id="modal-cadastrar-retorno" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="gridSystemModalLabel">Agendar Retorno</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/{{$perfil}}/retorno/cadastrar" method="POST" id="formulario"  autocomplete="off">
                <div class="modal-body">
                    <div class="text-danger" id="lista-erros"></div>
                    @csrf
                    <input type="hidden" name="id" id="id">
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
                                <input type="text" id="data-agendamento" name="data-agendamento" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div id="div-horario" style="display: none;">
                        <div class="form-group">
                            <div class="col-md-4">
                                <label for="horario-agendamento">Horário:</label>
                                <select name="horario-agendamento" id="horario-agendamento" class="form-control"></select>
                            </div>
                            <div class="col-md-12">
                                <div class="invalid-feedback" id="erro-agendamento" style="display: none;">
                                    Escolha um horário para o agendamentos
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn-cadastrar" class="btn btn-primary" style="display: none;">Agendar Retorno</button>
                </div>
            </form>

        </div>
    </div>
</div>
<script src="{{asset('js/pages/modal-retorno.js')}}"></script>

