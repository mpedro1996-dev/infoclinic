<?php

namespace Infoclinic\Http\Controllers;

use Illuminate\Http\Request;
use Infoclinic\Http\Requests\VinculoRegistroEspecialidadeRequest;
use Infoclinic\Model\Vinculo;
use Symfony\Component\VarDumper\VarDumper;

class VinculoRegistroEspecialidadeController extends Controller
{
    private $vinculo;
    //--------------------------------Magicos-----------------------------------//
    public function __construct(Vinculo $vinculo)
    {
        $this->vinculo = $vinculo;

    }
    //--------------------------------Privados----------------------------------//

    //--------------------------------Publicos----------------------------------//

    public function cadastrar(VinculoRegistroEspecialidadeRequest $request){
        $this->vinculo->find($request->get('vinculo_id'))->registroEspecialidades()->attach($request->get('registro_especialidade_id'));
        return response()->json([],200);
    }

    public function excluir(Request $request){
        $this->vinculo->find($request->get('vinculo_id'))->registroEspecialidades()->detach($request->get('registro_especialidade_id'));
        return response()->json(["message"=>"Especialidade deletada com sucesso"],200);

    }

    public function listar(Request $request){
        $idVinculo = $request->get('id');
        $registroEspecialidades = $this->vinculo->find($idVinculo)->registroEspecialidades()->get();

        $especialidades = [];
        foreach ($registroEspecialidades as $re){
            array_push($especialidades,["id"=>$re->id,"nome"=>$re->especialidade->nome]);
        }

        return response()->json($especialidades);
    }

    //---------------------------Getters e Setters------------------------------//
}
