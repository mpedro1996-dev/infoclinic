<?php

namespace Infoclinic\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Infoclinic\Model\Agendamento;
use Infoclinic\Model\Consulta;
use Infoclinic\Model\DiasAtendimento;

class RetornoController extends Controller
{
    private $consulta;
    private $diasAtendimento;
    private $agendamento;
    //--------------------------------Magicos-----------------------------------//
    public function __construct(Consulta $consulta, DiasAtendimento $diasAtendimento, Agendamento $agendamento)
    {
        $this->consulta = $consulta;
        $this->diasAtendimento = $diasAtendimento;
        $this->agendamento = $agendamento;

    }

    //--------------------------------Privados----------------------------------//
    private function carregarComboHorarios($horarioInicio,$horarioFim){
        $comboxHorario = [];

        while ($horarioInicio <= $horarioFim){
            $horarioString = $horarioInicio->format('H:i');


            array_push($comboxHorario,$horarioString);
            $horarioInicio->addMinutes(30);
        }
        return $comboxHorario;
    }

    private function listarDiasSemana($idVinculo){
        $diasAtendimento = $this->diasAtendimento->where('vinculo_id',$idVinculo)->orderBy('dia_semana')->get();
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


        return $array;
    }

    //--------------------------------Publicos----------------------------------//

    public function pegarDiasSemanas(Request $request){
        $consulta = $this->consulta->find($request->get('consulta_id'));
        $idVinculo = $consulta->agendamento->vinculo_id;

        $array = $this->listarDiasSemana($idVinculo);

        return response()->json($array,200);
    }

    public function pegarHorarios(Request $request){
        $consulta = $this->consulta->find($request->get('consulta_id'));
        $idVinculo = $consulta->agendamento->vinculo_id;

        $diasAtendimentos = $this->diasAtendimento
            ->where('vinculo_id',$idVinculo)
            ->where('dia_semana',$request->get('dia_semana'))->first();

        $horarioInicio =  Carbon::parse($diasAtendimentos->horario_inicio);

        $horarioFim    =  Carbon::parse($diasAtendimentos->horario_fim);

        $array =  $this->carregarComboHorarios($horarioInicio,$horarioFim);

        return response()->json($array,200);
    }

    public function cadastrarRetorno(Request $request){
        $id = $request->get('id');
        $dataAgendamento = $request->get('data-agendamento');
        $horarioAgendamento = $request->get('horario-agendamento');

        $dataHoraAgendamento = Carbon::createFromFormat('d/m/Y H:i',$dataAgendamento." ".$horarioAgendamento);


        $consulta = $this->consulta->find($id);

        $consultaRetorno = new $this->consulta();

        $consultaRetorno->status = Consulta::AGENDADO;
        $consultaRetorno->paciente_id = $consulta->paciente_id;
        $consultaRetorno->retorno_id = $consulta->id;
        $consultaRetorno->especialidade_id = $consulta->especialidade_id;

        $agendamento = new $this->agendamento([
            "vinculo_id"=>$consulta->agendamento->vinculo_id,
            "data_agendamento"=>$dataHoraAgendamento
        ]);

        $agendamento->save();

        $consultaRetorno->agendamento_id = $agendamento->id;

        $consultaRetorno->save();

        return back()->with(['msgCadastroRetorno'=>'success']);

    }

    //---------------------------Getters e Setters------------------------------//
}
