
@if(Hash::check('123mudar',Auth::user()->password))
    <script>
        $(document).ready(function () {
            $("#modal").modal("show");
        });
    </script>
    <div class="modal fade open" id="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="gridSystemModalLabel">Por favor, troque sua senha</h4>
                </div>
                <form action="/usuario/trocar" class="form-horizontal" method="post">
                    <div class="modal-body">
                        @include('erros')
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{Auth::user()->id}}">
                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Senha:</label>
                            <div class="col-md-8">
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Confirmar Senha:</label>
                            <div class="col-md-8">
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-offset-4">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif