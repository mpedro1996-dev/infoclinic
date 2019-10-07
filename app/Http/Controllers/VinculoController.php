<?php

namespace Infoclinic\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Infoclinic\Model\Especialidade;
use Infoclinic\Model\RegistroRegional;
use Infoclinic\Model\RegistrosRegionalEspecialidade;
use Infoclinic\Model\Vinculo;

class VinculoController extends Controller
{
    private $vinculo;
    private $registroRegional;
    private $especialidade;
    private $registroRegionalEspecialidade;

    //--------------------------------Magicos-----------------------------------//
    public function  __construct(Vinculo $vinculo, RegistroRegional $registroRegional,Especialidade $especialidade, RegistrosRegionalEspecialidade $registrosRegionalEspecialidade){
        $this->vinculo = $vinculo;
        $this->registroRegional = $registroRegional;
        $this->especialidade = $especialidade;
        $this->registroRegionalEspecialidade = $registrosRegionalEspecialidade;

    }

    //--------------------------------Privados----------------------------------//

    //--------------------------------Publicos----------------------------------//
    public function vincular($id){
        /** @var Vinculo $vinculo */
        $vinculo = new $this->vinculo();

        $vinculo->registro_id = $id;

        $vinculo->clinica_id = Auth::user()->clinica->id;

        $vinculo->save();

        return redirect()->action("VinculoController@listar")->with(["msgVincular"=>"success"]);

    }
    public function listar(Request $request){
        $consulta = $request->get('consulta',null);
        $paginate = $request->get('paginate',5);

        $collection = $this->vinculo
            ->join('registros_regional','vinculos.registro_id','=','registros_regional.id')
            ->join('estados','estados.id','=','registros_regional.estado_id')
            ->join('medicos','medicos.id','=','registros_regional.medico_id')
            ->join('usuarios','usuarios.medico_id','=','medicos.id')
            ->select('usuarios.nome as nome_medico','registros_regional.numero','vinculos.id','estados.uf');

        if($consulta!=null){
            $collection = $collection->where('usuarios.nome','like','%'.$consulta.'%');
        }

        return view('lista-vinculos')->with(['collection'=>$collection->paginate($paginate),'labelConsulta'=>'Nome','paginate'=>$paginate,'consulta'=>$consulta]);

    }

    public function desvincular($id){
        /** @var Vinculo $vinculo */
        $vinculo = $this->vinculo->find($id);


        $vinculo->delete();

        return redirect()->action("VinculoController@listar")->with(["msgDesvincular"=>"success"]);

    }

    public function meusVinculos(Request $request){
        $consulta = $request->get('consulta',null);
        $paginate = $request->get('paginate',5);

        $collection = $this->vinculo
            ->join('registros_regional','vinculos.registro_id','=','registros_regional.id')
            ->join('estados','estados.id','=','registros_regional.estado_id')
            ->join('clinicas','clinicas.id','=','vinculos.clinica_id')
            ->where('registros_regional.medico_id','=',Auth::user()->medico->id)
            ->select('clinicas.razao_social as razao_social','registros_regional.numero','vinculos.id','estados.uf');

        if($consulta!=null){
            $collection = $collection->where('clinicas.razao_social','like','%'.$consulta.'%');
        }

        return view('lista-vinculos-medicos')->with(['collection'=>$collection->paginate($paginate),'labelConsulta'=>'Clínica','paginate'=>$paginate,'consulta'=>$consulta]);

    }
    public function listarRegistroEspecialidade(Request $request){
        $idVinculo = $request->get('id');
        $vinculo = $this->vinculo->find($idVinculo);
        $registroRegionalEspecialidades = $this->registroRegionalEspecialidade->where('registros_regional_id',$vinculo->registroRegional->id)->get();

        $especialidades = [];
        foreach ($registroRegionalEspecialidades as $rre){
            array_push($especialidades,["id"=>$rre->id,"nome"=>$rre->especialidade->nome]);
        }

        return response()->json($especialidades);

    }




    //---------------------------Getters e Setters------------------------------//
}
