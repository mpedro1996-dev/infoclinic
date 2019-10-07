<?php

namespace Infoclinic\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Infoclinic\Model\Especialidade;
use Infoclinic\Model\LinhasProntuario;

class VisualizacaoPacienteProntuarioController extends Controller
{
    private $prontuario;
    private $especialidade;
    //--------------------------------Magicos-----------------------------------//
    public function __construct(LinhasProntuario $prontuario, Especialidade $especialidade)
    {
        $this->prontuario = $prontuario;
        $this->especialidade = $especialidade;
    }
    //--------------------------------Privados----------------------------------//

    //--------------------------------Publicos----------------------------------//
    public function listar(Request $request){
        $especialidades = $this->especialidade->all();
        $especialidade = $request->get('especialidade',null);
        $paginate = $request->get('paginate',5);

        $consultas = $this->prontuario
            ->join('consultas','linhas_prontuario.consulta_id','=','consultas.id')
            ->join('agendamentos','consultas.agendamento_id','=','agendamentos.id')
            ->join('vinculos','vinculos.id','=','agendamentos.vinculo_id')
            ->join('registros_regional','registros_regional.id','=','vinculos.registro_id')
            ->join('especialidades','especialidades.id','=','consultas.especialidade_id')
            ->join('medicos','registros_regional.medico_id','=','medicos.id')
            ->join('usuarios as usuarioMedico','usuarioMedico.medico_id','=','medicos.id')
            ->orderBy('linhas_prontuario.updated_at','desc')
            ->select('linhas_prontuario.id as id','usuarioMedico.nome as nome_medico','especialidades.nome as nomeEspecialidade','agendamentos.data_agendamento','linhas_prontuario.bloqueado','registros_regional.medico_id as idMedico')
            ->where('linhas_prontuario.paciente_id',Auth::user()->paciente->id);
        if($especialidade!=0){
            $consultas->where('consultas.especialidade_id',$especialidade);
        }

        return view('visualizacao-prontuario-paciente')->with(['collection'=>$consultas->paginate($paginate),'paginate'=>$paginate,'especialidades'=>$especialidades,'especialidade'=>$especialidade]);

    }

    public function detalhes($id){
        $consulta = $this->prontuario->find($id)->consulta;

        return view('detalhe-prontuario-paciente')->with(['consulta'=>$consulta]);

    }

    public function status($id){
        $prontuario =  $this->prontuario->find($id);

        if($prontuario->bloqueado == 0){
            $prontuario->bloqueado = 1;
        }else{
            $prontuario->bloqueado =0;
        }

        $prontuario->save();

        return redirect()->action('VisualizacaoPacienteProntuarioController@listar');

    }


    //---------------------------Getters e Setters------------------------------//

}
