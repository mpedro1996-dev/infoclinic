<?php

namespace Infoclinic\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Infoclinic\Model\Agendamento;
use Infoclinic\Model\Clinica;
use Infoclinic\Model\Consulta;
use Infoclinic\Model\DiasAtendimento;
use Infoclinic\Model\Especialidade;
use Infoclinic\Model\Vinculo;
use Infoclinic\Model\VinculoRegistroEspecialidade;
use Symfony\Component\VarDumper\VarDumper;

class AgendamentoController extends Controller
{
    private $especialidade;
    private $vinculo;
    private $diasAtendimento;
    private $agendamento;
    private $consulta;
    private $vinculosRegistrosEspecialidades;

    //--------------------------------Magicos-----------------------------------//
    public function __construct(Especialidade $especialidade, Vinculo $vinculo, DiasAtendimento $diasAtendimento, Agendamento $agendamento, Consulta $consulta, VinculoRegistroEspecialidade $vinculoRegistroEspecialidade)
    {
        $this->especialidade = $especialidade;
        $this->vinculo = $vinculo;
        $this->diasAtendimento = $diasAtendimento;
        $this->agendamento = $agendamento;
        $this->consulta = $consulta;
        $this->vinculosRegistrosEspecialidades=$vinculoRegistroEspecialidade;
    }

    //--------------------------------Privados----------------------------------//
    private function verificarAgendamentoDuplicado(Carbon $dataAgendamento, $vinculo,$paciente = null){
        $agendamentos = $this->agendamento->where('data_agendamento',$dataAgendamento)->where('vinculo_id',$vinculo)->get();
        $consultasPaciente =  $this->agendamento
            ->where('data_agendamento',$dataAgendamento)
            ->join('consultas','agendamentos.id','=','consultas.agendamento_id');

        if($paciente!=null){
            $consultasPaciente->where('consultas.paciente_id',$paciente);
        }else{
            $consultasPaciente->where('consultas.paciente_id',Auth::user()->paciente->id);
        }

        $consultasMedico =  $this->agendamento
            ->where('data_agendamento',$dataAgendamento)
            ->where('vinculo_id',$vinculo)
            ->join('consultas','agendamentos.id','=','consultas.agendamento_id')
            ->get();

        if(count($agendamentos)==0&&count($consultasPaciente->get())==0&&count($consultasMedico)==0){
            return true;
        }else{
            return false;
        }




    }

    private function carregarComboHorarios($horarioInicio,$horarioFim,Carbon $dataAgendamento,$vinculo,$paciente=null){
        $comboxHorario = [];

        while ($horarioInicio <= $horarioFim){
            $dataAgendamento->hour = $horarioInicio->hour;
            $dataAgendamento->minute = $horarioInicio->minute;
            $dataAgendamento->second = 0;
            if($this->verificarAgendamentoDuplicado($dataAgendamento,$vinculo,$paciente)) {
                $horarioString = $horarioInicio->format('H:i');

                array_push($comboxHorario, $horarioString);
            }
            $horarioInicio->addMinutes(30);

        }
        return $comboxHorario;
    }

    //--------------------------------Publicos----------------------------------//

    public function novo(){
        $especialidades =  $this->especialidade->all();

        return view('nova-consulta')->with(['especialidades'=>$especialidades]);

    }

    public function listarMedicos(Request $request){
        $especialidadeId = $request->get('especialidade');
        $nomeMedico      = $request->get('nomeMedico');
        $isPerto         = $request->get('estaPerto');
        $sexo            = $request->get('sexo');

        $medicos = $this->vinculo
            ->select('registros_regional.id','usuarios.nome as nome_medico','registros_regional.tipo_registro','registros_regional.numero','estados.uf','pacientes.sexo')
            ->join("registros_regional","vinculos.registro_id","=","registros_regional.id")
            ->join("registros_regional_especialidades","registros_regional.id","=","registros_regional_especialidades.registros_regional_id")
            ->join("vinculos_registro_especialidades","registros_regional_especialidades.id","=","vinculos_registro_especialidades.registro_especialidade_id")
            ->join("especialidades","registros_regional_especialidades.especialidade_id","=","especialidades.id")
            ->join("medicos","registros_regional.medico_id","=","medicos.id")
            ->join("usuarios","usuarios.medico_id","=","medicos.id")
            ->join("estados","registros_regional.estado_id","=","estados.id")
            ->join("pacientes","usuarios.paciente_id","=","pacientes.id")
            ->where("usuarios.nome","like","%".$nomeMedico."%")
            ->where("especialidades.id",$especialidadeId);

        if($isPerto==1){
            $medicos->where("estado.uf",Auth::user()->estado);
        }
        if($sexo!=null){
            $medicos->where("pacientes.sexo",$sexo);
        }

        return response()->json($medicos->get()->toArray(),200);

    }

    public function listarClinicas(Request $request){
        $especialidadeId = $request->get('especialidade');
        $registroId      = $request->get('registro_regional_id');
        $nomeClinica     = $request->get('nomeClinica');
        $isPerto         = $request->get('estaPerto');


        $clinicas = $this->vinculo
            ->select('vinculos.id as vinculo_id','clinicas.*')
            ->join("registros_regional","vinculos.registro_id","=","registros_regional.id")
            ->join("registros_regional_especialidades","registros_regional.id","=","registros_regional_especialidades.registros_regional_id")
            ->join("vinculos_registro_especialidades","registros_regional_especialidades.id","=","vinculos_registro_especialidades.registro_especialidade_id")
            ->join("clinicas","vinculos.clinica_id","=","clinicas.id")
            ->join("especialidades","registros_regional_especialidades.especialidade_id","=","especialidades.id")
            ->where("registro_id",$registroId)
            ->where("clinicas.razao_social","like","%".$nomeClinica."%")
            ->where("especialidades.id",$especialidadeId);

        if($isPerto==1){
            $clinicas->where('clinicas.cidade_clinica',Auth::user()->cidade);
        }

        $data = [];
        if(count($clinicas->get()->toArray())>0){
            foreach ($clinicas->get()->toArray() as $clinica){
                $endereco = $clinica['logradouro_clinica'].', '.$clinica['numero_clinica'].'. '.$clinica['bairro_clinica'];
                $cidade = $clinica['cidade_clinica'].', '.$clinica['estado_clinica'];
                $horario = $clinica['horario_inicio_func']." até ".$clinica['horario_fim_func'];
                $dias = "";
                if($clinica['domingo']==1){
                    $dias = $dias."Dom";
                }
                if($clinica['segunda']==1){
                    $dias = $dias.", ";
                    $dias = $dias."Seg";
                }
                if($clinica['terca']==1){
                    $dias = $dias.", ";
                    $dias = $dias."Ter";
                }
                if($clinica['quarta']==1){
                    $dias = $dias.", ";
                    $dias = $dias."Qua";
                }
                if($clinica['quinta']==1){
                    $dias = $dias.", ";
                    $dias = $dias."Qui";
                }
                if($clinica['sexta']==1){
                    $dias = $dias.", ";
                    $dias = $dias."Sex";
                }
                if($clinica['sabado']==1){
                    $dias = $dias.", ";
                    $dias = $dias."Sab";
                }
                $dias = $dias.".";

                array_push($data,[
                    "razao_social"=>$clinica['razao_social'],
                    "dias"=>$dias,"horario"=>$horario,
                    "endereco"=>$endereco,
                    "cidade"=>$cidade,
                    "vinculo_id"=>$clinica['vinculo_id']
                ]);
            }
        }

        return response()->json($data,200);

    }
    public function listarDiasSemana(Request $request){
        $diasAtendimento = $this->diasAtendimento->where('vinculo_id',$request->get("vinculo_id"))->orderBy('dia_semana')->get();
        $array = [];

        foreach ($diasAtendimento as $dia){
            if($dia->dia_semana==0){array_push($array,["dia"=>"Domingo","valor"=>0]);}
            if($dia->dia_semana==1){array_push($array,["dia"=>"Segunda-Feira","valor"=>1]);}
            if($dia->dia_semana==2){array_push($array,["dia"=>"Terça-Feira","valor"=>2]);}
            if($dia->dia_semana==3){array_push($array,["dia"=>"Quarta-Feira","valor"=>3]);}
            if($dia->dia_semana==4){array_push($array,["dia"=>"Quinta-Feira","valor"=>4]);}
            if($dia->dia_semana==5){array_push($array,["dia"=>"Sexta-Feira","valor"=>5]);}
            if($dia->dia_semana==6){array_push($array,["dia"=>"Sábado","valor"=>6]);}
        }


        return response()->json($array,200);
    }

    public function listarHorarios(Request $request){

        $diasAtendimentos = $this->diasAtendimento
            ->where('vinculo_id',$request->get('vinculo_id'))
            ->where('dia_semana',$request->get('dia_semana'))->first();


        $dataAgendamento = Carbon::createFromFormat('d/m/Y',$request->get('data'));

        $horarioInicio =  Carbon::parse($diasAtendimentos->horario_inicio);

        $horarioFim    =  Carbon::parse($diasAtendimentos->horario_fim);


        $array = $this->carregarComboHorarios($horarioInicio,$horarioFim,$dataAgendamento,$request->get('vinculo_id'),$request->get('paciente_id'));

        return response()->json($array,200);
    }

    public function cadastrar(Request $request){
        $dataAgendamento    = $request->get("data_agendamento");
        $horarioAgendamento = $request->get("horario_agendamento");
        $vinculoId          = $request->get("vinculo_id");
        $especialidadeId    = $request->get("especialidade_id");
        $pacienteId       = $request->get("paciente_id");


        $dataHoraAgendamento = Carbon::createFromFormat('d/m/Y H:i',$dataAgendamento." ".$horarioAgendamento);

        $agendamento = new $this->agendamento([
            "vinculo_id"=>$vinculoId,
            "data_agendamento"=>$dataHoraAgendamento
        ]);

        $agendamento->save();

        if($pacienteId){
            $consulta = new $this->consulta(["agendamento_id"=>$agendamento->id,"paciente_id"=>$pacienteId,"especialidade_id"=>$especialidadeId,"status"=>1]);
        }else{
            $consulta = new $this->consulta(["agendamento_id"=>$agendamento->id,"paciente_id"=>Auth::user()->paciente->id,"especialidade_id"=>$especialidadeId,"status"=>1]);

        }
        $consulta->save();



        return response()->json(["message"=>"Agendamento cadastrado com sucesso"],200);
    }

    //---------------------------Getters e Setters------------------------------//
}
