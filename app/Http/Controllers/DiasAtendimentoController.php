<?php

namespace Infoclinic\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Infoclinic\Http\Requests\DiasAtendimentoRequest;
use Infoclinic\Model\DiasAtendimento;
use Infoclinic\Model\Vinculo;
use Symfony\Component\VarDumper\VarDumper;

class DiasAtendimentoController extends Controller
{
    private $diasAtendimento;
    private $vinculo;
    //--------------------------------Magicos-----------------------------------//
    public function __construct(DiasAtendimento $diasAtendimento, Vinculo $vinculo){
        $this->diasAtendimento = $diasAtendimento;
        $this->vinculo = $vinculo;
    }


    //--------------------------------Privados----------------------------------//
    private function carregarDiasDaClinica($clinica){

        $diasSemanas = [];

        if($clinica->domingo==1){
            array_push($diasSemanas,["valor"=>0,"descricao"=>"Domingo"]);
        }
        if($clinica->segunda==1){
            array_push($diasSemanas,["valor"=>1,"descricao"=>"Segunda-Feira"]);

        }
        if($clinica->terca==1){
            array_push($diasSemanas,["valor"=>2,"descricao"=>"Terca-Feira"]);

        }
        if($clinica->quarta==1){
            array_push($diasSemanas,["valor"=>3,"descricao"=>"Quarta-Feira"]);

        }
        if($clinica->quinta==1){
            array_push($diasSemanas,["valor"=>4,"descricao"=>"Quinta-Feira"]);

        }
        if($clinica->sexta==1){
            array_push($diasSemanas,["valor"=>5,"descricao"=>"Sexta-Feira"]);

        }
        if($clinica->sabado==1){
            array_push($diasSemanas,["valor"=>6,"descricao"=>"Sabado"]);

        }

        return $diasSemanas;
    }

    private function carregarComboHorarios($horarioInicio,$horarioFim){
        $comboxHorario = [];

        while ($horarioInicio <= $horarioFim){
            $horarioString = $horarioInicio->format('H:i');


            array_push($comboxHorario,$horarioString);
            $horarioInicio->addMinutes(30);
        }
        return $comboxHorario;
    }



    //--------------------------------Publicos----------------------------------//
    public function novo($id){
        $vinculo = $this->vinculo->find($id);


        $clinica = $vinculo->clinica;

        $diasSemanas = $this->carregarDiasDaClinica($clinica);

        $horarioInicio = Carbon::parse($clinica->horario_inicio_func);

        $horarioFim = Carbon::parse($clinica->horario_fim_func);

        $comboxHorario = $this->carregarComboHorarios($horarioInicio,$horarioFim);

        return view('novo-dia-atendimento')->with([
            'idVinculo'=>$id,
            'diasSemanas'=>$diasSemanas,
            'comboxHorario'=>$comboxHorario,

        ]);
    }

    public function cadastrar(DiasAtendimentoRequest $request){
        /** @var DiasAtendimento $diaAtendimento */
        if($request->input('id')){
            $diaAtendimento = $this->diasAtendimento->find($request->input('id'));
            $diaAtendimento->update($request->all());
        }else{
            $diaAtendimento = new $this->diasAtendimento($request->all());
            $diaAtendimento->save();
        }
        return redirect()->action("DiasAtendimentoController@listar")->with(["msgDiaAtendimento"=>"success"]);


    }

    public function listar(Request $request){
        $consulta = $request->get('consulta',null);
        $paginate = $request->get('paginate',5);

        $collection = $this->diasAtendimento
            ->join('vinculos','dias_atendimento.vinculo_id','=','vinculos.id')
            ->join('registros_regional','vinculos.registro_id','=','registros_regional.id')
            ->join('clinicas','clinicas.id','=','vinculos.clinica_id')
            ->where('registros_regional.medico_id','=',Auth::user()->medico->id)
            ->select('clinicas.razao_social as razao_social','dias_atendimento.*');

        if($consulta!=null){
            $collection = $collection->where('clinicas.razao_social','like','%'.$consulta.'%');
        }

        return view('lista-dias-atendimento')->with(['collection'=>$collection->paginate($paginate),'labelConsulta'=>'Clínica','paginate'=>$paginate,'consulta'=>$consulta]);

    }

    public function alterar($id){
        $diaAtendimento = $this->diasAtendimento->find($id);

        $clinica = $diaAtendimento->vinculo->clinica;

        $diasSemanas = $this->carregarDiasDaClinica($clinica);

        $horarioInicio = Carbon::parse($clinica->horario_inicio_func);

        $horarioFim = Carbon::parse($clinica->horario_fim_func);

        $comboxHorario = $this->carregarComboHorarios($horarioInicio,$horarioFim);

        $horarioInicioString = date('H:i',strtotime($diaAtendimento->horario_inicio));
        $horarioFimString    = date('H:i',strtotime($diaAtendimento->horario_fim));



        return view('novo-dia-atendimento')->with([
            'idVinculo'=>$diaAtendimento->vinculo->id,
            'diasSemanas'=>$diasSemanas,
            'comboxHorario'=>$comboxHorario,
            'diaAtendimento'=>$diaAtendimento,
            'horarioInicio'=>$horarioInicioString,
            'horarioFim'=>$horarioFimString,
            'id'=>$id

        ]);



    }

    public function excluir($id){
        $diaAtendimento = $this->diasAtendimento->find($id);

        $diaAtendimento->delete();

        return redirect()->action("DiasAtendimentoController@listar")->with(["msgExcluirDiaAtendimento"=>"success"]);

    }

    //---------------------------Getters e Setters------------------------------//

}
