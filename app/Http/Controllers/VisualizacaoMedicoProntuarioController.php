<?php

namespace Infoclinic\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Infoclinic\Model\Especialidade;
use Infoclinic\Model\LinhasProntuario;

class VisualizacaoMedicoProntuarioController extends Controller
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
    public function listar(Request $request,$id){
        $especialidades = $this->especialidade->all();
        $especialidade = $request->get('especialidade',null);
        $somenteMeus   = $request->get('somente_meus')?true:false;
        $paginate = $request->get('paginate',5);

        $consultas = $this->prontuario
            ->join('consultas','linhas_prontuario.consulta_id','=','consultas.id')
            ->join('agendamentos','consultas.agendamento_id','=','agendamentos.id')
            ->join('vinculos','vinculos.id','=','agendamentos.vinculo_id')
            ->join('registros_regional','registros_regional.id','=','vinculos.registro_id')
            ->join('especialidades','especialidades.id','=','consultas.especialidade_id')
            ->orderBy('linhas_prontuario.updated_at','desc')
            ->select('linhas_prontuario.id as id','especialidades.nome as nomeEspecialidade','agendamentos.data_agendamento','linhas_prontuario.bloqueado','registros_regional.medico_id as idMedico')
            ->where('linhas_prontuario.paciente_id',$id);
        if($especialidade!=0){
            $consultas->where('consultas.especialidade_id',$especialidade);
        }
        if($somenteMeus==true){
            $consultas->where('registros_regional.medico_id',Auth::user()->medico->id);

        }

        $exames = $this->prontuario->join('exames','exames.id','=','linhas_prontuario.exame_id')
            ->where('linhas_prontuario.paciente_id',$id)
            ->where('linhas_prontuario.bloqueado',0)
            ->orderBy('linhas_prontuario.created_at','desc')
            ->select('exames.descricao','linhas_prontuario.created_at','exames.nome_arquivo');

        return view('visualizacao-prontuario-medico')->with(['collectionConsultas'=>$consultas->paginate($paginate),'collectionExames'=>$exames->paginate($paginate),'paginate'=>$paginate,'especialidades'=>$especialidades,'especialidade'=>$especialidade,'somente_meus'=>$somenteMeus?1:0,'id'=>$id]);

    }

    public function detalhes($id){
        $consulta = $this->prontuario->find($id)->consulta;

        return view('detalhe-prontuario-medico')->with(['consulta'=>$consulta]);

    }


    //---------------------------Getters e Setters------------------------------//
}
