<?php

namespace Infoclinic\Http\Controllers;

use Illuminate\Http\Request;
use Infoclinic\Http\Requests\PrescricaoRequest;
use Infoclinic\Model\Prescricao;

class PrescricaoController extends Controller
{
    private $prescricao;
    //--------------------------------Magicos-----------------------------------//
    public function __construct(Prescricao $prescricao)
    {
        $this->prescricao = $prescricao;
    }

    //--------------------------------Privados----------------------------------//

    //--------------------------------Publicos----------------------------------//
    public function cadastrar(PrescricaoRequest $request){
        $prescricao = new $this->prescricao($request->all());
        $prescricao->save();
        return response()->json([],200);

    }

    public function listar(Request $request){
        $prescricoes = $this->prescricao->where('consulta_id',$request->get('id'))->get();
        $response = [];
        if(count($prescricoes)>0){
            foreach ( $prescricoes as $prescricao){
                array_push($response,[
                    'id'=>$prescricao->id,
                    'nome'=>$prescricao->nome_remedio,
                    'posologia'=>$prescricao->periodo
                ]);

            }
        }

        return response()->json($response,200);

    }

    public function deletar(Request $request){
        $prescricao =  $this->prescricao->find($request->get('id'));
        $prescricao->delete();
        return response()->json(["message"=>"Prescrição deletada com sucesso"],200);
    }

    //---------------------------Getters e Setters------------------------------//
}
