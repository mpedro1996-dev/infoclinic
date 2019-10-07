@extends('principal')
@section('content')
    @include('_navbar-medico')
    <div class	="container-fluid">
        <div class="py-4">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-info text-white"><i class="fa fa-search"></i> Procurar</div>
                        <div class=card-body>
                            <form action="">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-md-right">Paginação</label>
                                    <div class="col-md-4">
                                        <select name="paginate" class="form-control">
                                            @for($i=5;$i<=50;$i+=5)
                                                <option>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-3">
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" checked>
                                            <label class="form-check-label" for="exampleCheck1">Hoje</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="#" class="btn btn-primary"><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-primary text-white"><i class="far fa-calendar-alt"></i> Agenda</div>
                        <div class="card-body">

                            <table class="table table-bordered table-striped table-hover">
                                <thead class="thead-dark">
                                <tr>
                                    <th>Paciente</th>
                                    <th>Data de Agendamento</th>
                                    <th>Clínica</th>
                                    <th>Especialidade</th>
                                    <th>Status de Consulta</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody id="tabela-corpo">
                                    <tr>
                                        <td>Pedro Martins de Moura</td>
                                        <td>26/07/2018 14:00h</td>
                                        <td>Clínica Legal</td>
                                        <td>Acupuntura</td>
                                        <td>Aguardando Atendimento</td>
                                        <td><a href="#" class="btn btn-primary">Atender</a></td>
                                    </tr>
                                    <tr>
                                        <td>Matheus Martins de Moura</td>
                                        <td>27/07/2018 14:00h</td>
                                        <td>Clínica Maravilhosa</td>
                                        <td>Clínica Médica</td>
                                        <td>Fechado</td>
                                        <td><a href="#" class="btn btn-dark">Prescrição</a></td>
                                    </tr>
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination pagination-lg justify-content-center">
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection