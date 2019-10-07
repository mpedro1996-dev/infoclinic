<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'WelcomeController@index');
Route::get('/nossas-especialidades','WelcomeController@especialidades');
Route::get('/nossas-clinicas','WelcomeController@clinicas');
Route::get('/nossos-medicos','WelcomeController@medicos');

Route::get('home', 'HomeController@index');
Route::get('/acesso-negado','HomeController@acessoNegado');

Route::group(['middleware'=>['auth','acesso']], function(){
    //Controle da Home
    Route::get("/editar/{id}","UserController@editar");
    Route::get("/visualizar/{id}","UserController@visualizar");
    Route::post("/usuario/editado","UserController@editado");
    Route::post("/usuario/trocar","UserController@trocarSenha");

    //Controles de Usuarios por administrador
    Route::group(['prefix'=>'administrador'],function (){
        Route::get("/atendente/listar","AtendenteController@listar");
        Route::get("/atendente/novo","AtendenteController@novo");
        Route::post("/atendente/novo","AtendenteController@cadastrar");

        Route::get("/atendente/visualizar/{id}","UserController@visualizar");
        Route::get("/atendente/editar/{id}","UserController@editar");

        Route::get("/paciente/listar","PacienteController@listar");
        Route::get("/paciente/visualizar/{id}","UserController@visualizar");
        Route::get("/paciente/editar/{id}","UserController@editar");

        Route::get("/medico/listar","MedicoController@listar");
        Route::get("/medico/novo","MedicoController@novo");
        Route::post("/medico/novo","MedicoController@cadastrar");
        Route::get("/medico/visualizar/{id}","UserController@visualizar");
        Route::get("/medico/editar/{id}","UserController@editar");


        Route::get("/clinica/visualizar/{id}","UserController@visualizar");
        Route::get("/clinica/editar/{id}","UserController@editar");

        Route::get("/medico/permitir/{id}","MedicoController@permitir");
    });

    //Controles de Usuarios por clinica
    Route::group(['prefix'=>'clinica'],function (){
        Route::get("/atendente/listar","AtendenteController@listar");
        Route::get("/atendente/novo","AtendenteController@novo");
        Route::post("/atendente/novo","AtendenteController@cadastrar");
        Route::get("/atendente/visualizar/{id}","UserController@visualizar");
        Route::get("/atendente/editar/{id}","UserController@editar");

        Route::get("/paciente/listar","PacienteController@listar");
        Route::get("/paciente/visualizar/{id}","UserController@visualizar");
        Route::get("/paciente/editar/{id}","UserController@editar");

        Route::get("/medico/listar","MedicoController@listar");
        Route::get("/medico/novo","MedicoController@novo");
        Route::get("/medico/visualizar/{id}","UserController@visualizar");
        Route::get("/medico/editar/{id}","UserController@editar");

        Route::get("/medico/conselhos-regionais/listar","RegistroRegionalController@listar");


        Route::get("/medico/permitir/{id}","MedicoController@permitir");

        Route::get("/vinculos/vincular/{id}","VinculoController@vincular");
        Route::get("/vinculos/desvincular/{id}","VinculoController@desvincular");
        Route::get("/vinculos/listar","VinculoController@listar");
        Route::get("/vinculos/listar-especialidades-registro-regional","VinculoController@listarRegistroEspecialidade");
        Route::get("/vinculos/especialidades/listar","VinculoRegistroEspecialidadeController@listar");
        Route::post("/vinculos/especialidades/cadastrar","VinculoRegistroEspecialidadeController@cadastrar");
        Route::get("/vinculos/especialidades/deletar","VinculoRegistroEspecialidadeController@excluir");
    });

    Route::group(['prefix'=>'medico'],function (){
        Route::get("/conselhos-regionais/novo","RegistroRegionalController@novo");
        Route::get("/conselhos-regionais","RegistroRegionalController@meusRegistros");
        Route::post("/conselhos-regionais","RegistroRegionalController@cadastrar");
        Route::get("/conselhos-regionais/mudar-status/{id}","RegistroRegionalController@status");

        Route::post("/conselhos-regionais/especialidade/cadastrar","RegistrosRegionalEspecialidadeController@cadastrar");
        Route::get("/conselhos-regionais/especialidade/listar","RegistrosRegionalEspecialidadeController@listar");
        Route::get("/conselhos-regionais/especialidade/delete","RegistrosRegionalEspecialidadeController@deletar");

        Route::get("/vinculos/listar","VinculoController@meusVinculos");

        Route::get("/dias-atendimento/novo/{id}","DiasAtendimentoController@novo");
        Route::get("/dias-atendimento/alterar/{id}","DiasAtendimentoController@alterar");
        Route::get("/dias-atendimento/excluir/{id}","DiasAtendimentoController@excluir");
        Route::post("/dias-atendimento/novo","DiasAtendimentoController@cadastrar");
        Route::get("/dias-atendimento/listar","DiasAtendimentoController@listar");

        Route::get("/consultas/listar","AgendaMedicoController@listar");
        Route::get("/consultas/abrir/{id}","AgendaMedicoController@abrirConsulta");
        Route::get("/consultas/prescricao/pdf/{id}","AgendaMedicoController@pdf");
        Route::post("/consultas/cadastrar","ConsultaController@cadastrar");

        Route::post('/prescricao/cadastrar','PrescricaoController@cadastrar');
        Route::get('/prescricao/listar','PrescricaoController@listar');
        Route::get("/prescricao/delete","PrescricaoController@deletar");

        Route::get('/prontuario/listar/{id}','VisualizacaoMedicoProntuarioController@listar');
        Route::get('/prontuario/detalhe/{id}','VisualizacaoMedicoProntuarioController@detalhes');



    });

    Route::group(['prefix'=>'paciente'],function (){
        Route::get("/consulta/novo","AgendamentoController@novo");
        Route::get("/agendamento/listar-medicos","AgendamentoController@listarMedicos");
        Route::get("/agendamento/listar-clinicas","AgendamentoController@listarClinicas");
        Route::get("/agendamento/listar-dias-semana","AgendamentoController@listarDiasSemana");
        Route::get("/agendamento/listar-horarios","AgendamentoController@listarHorarios");
        Route::post("/agendamento/cadastrar","AgendamentoController@cadastrar");


        Route::get("/exames/listar","ExameController@listar");
        Route::get("/exames/novo","ExameController@novo");
        Route::post("/exames/novo","ExameController@cadastrar");
        Route::get("/exames/mudar-status/{id}","ExameController@status");
        Route::get("/exames/excluir/{id}","ExameController@excluir");

        Route::get('/prontuario/listar','VisualizacaoPacienteProntuarioController@listar');
        Route::get('/prontuario/detalhe/{id}','VisualizacaoPacienteProntuarioController@detalhes');
        Route::get('/prontuario/mudar-status/{id}','VisualizacaoPacienteProntuarioController@status');

        Route::get("/consultas/listar","ConsultasPacienteController@listar");
        Route::get("/consultas/salvar-cancelamento/{id}","ConsultasPacienteController@salvarCancelamento");

        Route::post("/retorno/cadastrar","RetornoController@cadastrarRetorno");




    });

    Route::group(['prefix'=>'atendente'],function (){
        Route::get("/consultas/listar","EntradaConsultaController@listar");
        Route::get("/consultas/mudar-status/{id}","EntradaConsultaController@status");
        Route::get("/consultas/cancelar/{id}","EntradaConsultaController@novoCancelamento");
        Route::get("/consultas/cancelar-por-falta/{id}","EntradaConsultaController@novaFalta");
        Route::post("/consultas/salvar-cancelamento","EntradaConsultaController@salvarCancelamento");

        Route::get("/agendamento/selecionar-paciente","AtendenteAgendamentoController@selecionarPaciente");
        Route::post("/agendamento/validar-paciente","AtendenteAgendamentoController@validarPaciente");
        Route::post("/agendamento/selecionar-horario","AtendenteAgendamentoController@selecionarHorario");


        Route::post("/retorno/cadastrar","RetornoController@cadastrarRetorno");

    });

    //Requisições para retorno
    Route::get("/retorno/listar-dias-semana","RetornoController@pegarDiasSemanas");
    Route::get("/retorno/listar-horarios","RetornoController@pegarHorarios");


    //Controle da Clinica pelo Administrador
    Route::get("/clinica","ClinicaController@index");
    Route::get("/clinica/listar","ClinicaController@listar");
    Route::get("/clinica/novo","ClinicaController@novo");
    Route::post("/clinica/novo","ClinicaController@cadastrar");
    Route::get("/clinica/mudar-status/{id}","ClinicaController@status");

    //Controle de Administradores por administrador
    Route::get("/administrador","AdministradorController@index");
    Route::get("/administrador/listar","AdministradorController@listar");
    Route::get("/administrador/novo","AdministradorController@novo");
    Route::post("/administrador/novo","AdministradorController@cadastrar");
    Route::get("/administrador/mudar-status/{id}","AdministradorController@status");

    //Controle dos perfis
    Route::get("/administrador/editar/{id}","UserController@editar");
    Route::get("/paciente/editar/{id}","UserController@editar");
    Route::get("/medico/editar/{id}","UserController@editar");
    Route::get("/atendente/editar/{id}","UserController@editar");
    Route::get("/clinica/editar/{id}","UserController@editar");

    Route::get("/administrador/visualizar/{id}","UserController@visualizar");
    Route::get("/paciente/visualizar/{id}","UserController@visualizar");
    Route::get("/medico/visualizar/{id}","UserController@visualizar");
    Route::get("/atendente/visualizar/{id}","UserController@visualizar");
    Route::get("/clinica/visualizar/{id}","UserController@visualizar");




    //Atribuir Perfil
    Route::get("/administrador/pre-cadastro","UserController@preCadastro");
    Route::get("/clinica/pre-cadastro","UserController@preCadastro");
    Route::get("/atendente/pre-cadastro","UserController@preCadastro");
    Route::post("/pre-cadastro","UserController@verificarCpf");
    Route::get("/administrador/permitir/{id}","AdministradorController@permitir");

    Route::post("/clinica/permitir","ClinicaController@permitir");
    Route::post("/administrador/atendente/permitir","AtendenteController@permitir");
    Route::post("/clinica/atendente/permitir","AtendenteController@permitir");
    //Paciente
    Route::get("/paciente","PacienteController@index");
    //Atendente
    Route::get("/atendente","AtendenteController@index");
    Route::get("/atendente/mudar-status/{id}","AtendenteController@status");
    //Medico
    Route::get("/medico","MedicoController@index");
    Route::get("/medico/mudar-status/{id}","MedicoController@status");

    //Conselhos Regionais
    Route::get("/medico/conselhos-regionais/novo","RegistroRegionalController@novo");
    Route::get("/medico/conselhos-regionais","RegistroRegionalController@meusRegistros");
    Route::post("/conselhos-regionais","RegistroRegionalController@cadastrar");
    Route::get("/conselhos-regionais/delete/{id}","RegistroRegionalController@deletar");

});

Route::group(["prefix"=>"mockup"],function (){
    Route::get("/agendamento-medico","MockupController@agendamentoMedico");
    Route::get("/consulta","MockupController@consulta");
    //Route::get("/preescricao-pdf","");

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
