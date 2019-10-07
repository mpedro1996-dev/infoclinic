<div class="modal fade" id="modal-cadastrar-prescricao" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="gridSystemModalLabel">Prescrição Médica</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-danger" id="lista-erros"></div>

                <form>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-right">Medicamento</label>
                        <div class="col-md-4">
                            <input type="text" name="medicamento" id="medicamento" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-right">Quantidade</label>
                        <div class="col-md-4">
                            <input type="text" name="quantidade" id="quantidade" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-right">Forma Farmacêutica</label>
                        <div class="col-md-4">
                            <input type="text" name="unidade_medida" id="unidade-medida" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-right">Posologia</label>
                        <div class="col-md-4">
                            <input type="text" name="posologia" id="posologia" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="ml-auto col-md-9">
                            <button type="button" class="btn btn-primary" id="btn-enviar">Cadastrar</button>
                        </div>
                    </div>
                </form>
                <table class="table table-striped  table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th>Medicamento</th>
                        <th>Posologia</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody id="tbody-lista-prescricao">
                    <tr>
                        <td colspan="3">Não há registros cadastros</td>
                    </tr>
                    </tbody>

                </table>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

