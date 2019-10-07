<?php

namespace Infoclinic\Http\Controllers;

use Illuminate\Http\Request;
use Infoclinic\Http\Requests\RegistrosRegionalEspecialidadeRequest;
use Infoclinic\Model\RegistroRegional;
use Infoclinic\Model\RegistrosRegionalEspecialidade;
use Symfony\Component\VarDumper\VarDumper;

class RegistrosRegionalEspecialidadeController extends Controller
{
    private $registroRegionalEspecialidade;
    private $registroRegional;
    //--------------------------------Magicos-----------------------------------//
    public function __construct(RegistrosRegionalEspecialidade $registrosRegionalEspecialidade, RegistroRegional $registroRegional){
        $this->registroRegionalEspecialidade = $registrosRegionalEspecialidade;
        $this->registroRegional = $registroRegional;
    }

    //--------------------------------Privados----------------------------------//

    //--------------------------------Publicos----------------------------------//
    public function cadastrar(RegistrosRegionalEspecialidadeRequest $request){
        $registroRegionalEspecialidade = new $this->registroRegionalEspecialidade($request->all());
        $registroRegionalEspecialidade->save();
        return response()->json([],200);

    }
    public function listar(Request $request){
        $especialidades = $this->registroRegionalEspecialidade->where("registros_regional_id",$request->get('id'))->get();
        $response = [];
        if(count($especialidades)>0){
            foreach ($especialidades as $e){
                array_push($response,[
                    "nome"=>$e->especialidade->nome,
                    "id"=>$e->id
                ]);
            }
        }
        return response()->json($response,200);
    }
    public function deletar(Request $request){
        $registro = $this->registroRegionalEspecialidade->find($request->get('id'));
        $registro->delete();
        return response()->json(["message"=>"Especialidade deletada com sucesso"],200);
    }



    //---------------------------Getters e Setters------------------------------//
}
