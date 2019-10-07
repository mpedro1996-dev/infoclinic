<?php

namespace Infoclinic\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Infoclinic\Model\Especialidade;
use Infoclinic\Model\Paciente;
use Infoclinic\Model\Vinculo;
use Symfony\Component\VarDumper\VarDumper;

class AtendenteAgendamentoController extends Controller
{
    private $paciente;
    private $vinculo;
    private $especialidade;
    //--------------------------------Magicos-----------------------------------//
    public function __construct(Paciente $paciente, Vinculo $vinculo, Especialidade $especialidade)
    {
        $this->paciente = $paciente;
        $this->vinculo = $vinculo;
        $this->especialidade = $especialidade;

    }

    //--------------------------------Privados----------------------------------//

    //--------------------------------Publicos----------------------------------//

    public function selecionarPaciente(){
        $especialidades = $this->especialidade->all();
        return view('atendente-agendamento-selecionar-paciente')->with(['especialidades'=>$especialidades]);
    }
    public function validarPaciente(Request $request){
        $cpf = $request->get('cpf');
        $especialidade =  $request->get('especialidade');

        $paciente = $this->paciente->where('cpf',$cpf)->first();

        if($paciente==null){
            return redirect()->action('AtendenteAgendamentoController@selecionarPaciente')->with(['msg404'=>'success']);
        }else{
            $vinculos = $this->vinculo
                ->select('registros_regional.id','usuarios.nome as nome_medico','registros_regional.tipo_registro','registros_regional.numero','estados.uf','pacientes.sexo')
                ->join("registros_regional","vinculos.registro_id","=","registros_regional.id")
                ->join("registros_regional_especialidades","registros_regional.id","=","registros_regional_especialidades.registros_regional_id")
                ->join("vinculos_registro_especialidades","registros_regional_especialidades.id","=","vinculos_registro_especialidades.registro_especialidade_id")
                ->join("especialidades","registros_regional_especialidades.especialidade_id","=","especialidades.id")
                ->join("medicos","registros_regional.medico_id","=","medicos.id")
                ->join("usuarios","usuarios.medico_id","=","medicos.id")
                ->join("estados","registros_regional.estado_id","=","estados.id")
                ->join("pacientes","usuarios.paciente_id","=","pacientes.id")
                ->where("vinculos.clinica_id",Auth::user()->atendente->clinica_id)
                ->where("especialidades.id",$especialidade)->get();


            if(count($vinculos)==0){
                return redirect()->action('AtendenteAgendamentoController@selecionarPaciente')->with(['msg404Especialidade'=>'success']);

            }else{
                return view('atendente-agendamento-selecionar-medico')->with(['vinculos'=>$vinculos,'paciente'=>$paciente,'especialidade'=>$especialidade]);
            }
        }

    }
    public function selecionarHorario(Request $request){
        $pacienteId = $request->get('paciente_id');
        $especialidadeId = $request->get('especialidade_id');
        $vinculoId = $request->get('vinculo_id');

        return view('atendente-agendamento-selecionar-horario')->with(['paciente'=>$pacienteId,'especialidade'=>$especialidadeId,'vinculo'=>$vinculoId]);
    }

    //---------------------------Getters e Setters------------------------------//
}
