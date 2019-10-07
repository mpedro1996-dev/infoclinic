<?php

namespace Infoclinic\Http\Controllers;

use Illuminate\Http\Request;
use Infoclinic\Http\Requests\ConsultaRequest;
use Infoclinic\Model\Consulta;
use Infoclinic\Model\LinhasProntuario;
use Infoclinic\Model\Paciente;

class ConsultaController extends Controller
{
    private $consulta;
    private $paciente;
    private $prontuario;
    //--------------------------------Magicos-----------------------------------//
    public function __construct(Consulta $consulta, Paciente $paciente, LinhasProntuario $prontuario)
    {
        $this->consulta = $consulta;
        $this->paciente = $paciente;
        $this->prontuario = $prontuario;
    }
    //--------------------------------Privados----------------------------------//

    //--------------------------------Publicos----------------------------------//
    public function cadastrar(ConsultaRequest $request){
        $consulta = $this->consulta->find($request->get('consulta_id'));
        $paciente = $this->paciente->find($consulta->paciente_id);
        $consulta->fill($request->all());
        $consulta->status = Consulta::FECHADO;
        $consulta->update();
        $paciente->update(['peso'=>$request->get('peso'),'altura'=>$request->get('altura')]);

        $bloqueado = 1;
        if($request->get('autorizacao')){
            $bloqueado = 0;
        }
        $prontuario = new $this->prontuario(['paciente_id'=>$consulta->paciente_id,'consulta_id'=>$consulta->id,'bloqueado'=>$bloqueado]);
        $prontuario->save();

        $consultaId = null;
        if(count($consulta->prescricoes)>0){
            $consultaId = $request->get('consulta_id');
        }

        return redirect()->action('AgendaMedicoController@listar')->with(['msgFechamentoConsulta'=>'success','consulta_id'=>$consultaId]);

    }

    //---------------------------Getters e Setters------------------------------//
}
