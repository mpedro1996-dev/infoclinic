<div class="modal fade" id="modal-cadastrar-especialidade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="gridSystemModalLabel">Especialidades do Registro Regional</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('erros')
                <div class="text-danger" id="lista-erros"></div>

                <form>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-right">Especialidade</label>
                        <div class="col-md-4">
                            <select class="form-control" name="especialidade" id="especialidade">
                                @foreach($especialidades as $e)
                                    <option value="{{$e->id}}">{{$e->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-primary" id="btn-enviar">Cadastrar</button>
                        </div>
                    </div>
                </form>
                <table class="table table-striped  table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th>Especialidade</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody id="tbody-lista-especialidade">
                    <tr>
                        <td colspan="2">Não há registros cadastros</td>
                    </tr>
                    </tbody>

                </table>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>