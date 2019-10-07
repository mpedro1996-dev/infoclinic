<?php

namespace Infoclinic\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Infoclinic\Model\Agendamento;
use Infoclinic\Model\Consulta;
use Symfony\Component\VarDumper\VarDumper;

class ConsultasPacienteController extends Controller
{
    private $consulta;
    private $agendamento;
    //--------------------------------Magicos-----------------------------------//
    public function __construct(Consulta $consulta, Agendamento $agendamento)
    {
        $this->consulta = $consulta;
        $this->agendamento = $agendamento;
    }
    //--------------------------------Privados----------------------------------//
    private function isDesmarcable(Carbon $dataAgendamento){
        $hoje = Carbon::now();
        $diferenca = $dataAgendamento->diffInDays($hoje);

        if($diferenca>=1){
            return 1;
        }else{
            return 0;
        }
    }

    private function isMarcable(Carbon $dataAgendamento, Consulta $consulta){
        $hoje = Carbon::now();
        $diferenca = $dataAgendamento->diffInDays($hoje);

        if($consulta->retorno==null){
            if($diferenca<=30){

                return 1;
            }else{
                return 0;
            }
        }else{
            return 0;
        }

    }

    //--------------------------------Publicos----------------------------------//
    public function listar(Request $request){
        $nomeClinica    = $request->get('nome_clinica',null);
        $nomeMedico     = $request->get('nome_medico',null);
        $statusConsulta = $request->get('status_consulta',Consulta::AGENDADO);
        $dataHoje       = $request->get('data_hoje')?true:false;

        $paginate = $request->get('paginate',5);


        $consultas = $this->consulta->join('pacientes','pacientes.id','=','consultas.paciente_id')
            ->join('agendamentos','agendamentos.id','=','consultas.agendamento_id')
            ->join('vinculos','agendamentos.vinculo_id','=','vinculos.id')
            ->join('registros_regional','vinculos.registro_id','=','registros_regional.id')
            ->join('medicos','medicos.id','=','registros_regional.medico_id')
            ->join('usuarios as usuarioMedico','usuarioMedico.medico_id','=','medicos.id')
            ->join('clinicas','clinicas.id','=','vinculos.clinica_id')
            ->join('especialidades','consultas.especialidade_id','=','especialidades.id')
            ->select('consultas.id','clinicas.razao_social as nomeClinica','especialidades.nome as nomeEspecialidade','usuarioMedico.nome as nomeMedico','agendamentos.data_agendamento','consultas.status')
            ->where('consultas.paciente_id',Auth::user()->paciente->id);

        if($nomeClinica!=null){
            $consultas->where('clinicas.razao_social','like','%'.$nomeClinica.'%');
        }
        if($nomeMedico!=null){
            $consultas->where('usuarioMedico.nome','like','%'.$nomeMedico.'%');
        }
        if($statusConsulta!=null){
            $consultas->where('consultas.status',$statusConsulta);
        }
        if($dataHoje==true){
            $hoje = Carbon::today();
            $consultas->whereDate('agendamentos.data_agendamento',$hoje->toDateString());
        }


        $collection = $consultas->paginate($paginate);

        foreach($collection as $c){
            if($c->status == Consulta::AGENDADO){
                $data = new Carbon($c->data_agendamento);
                $c->desmarcavel = $this->isDesmarcable($data);
            }
            if($c->status == Consulta::FECHADO){
                $data = new Carbon($c->data_agendamento);
                $consulta = $this->consulta->find($c->id);
                $c->marcavel = $this->isMarcable($data, $consulta);
            }
        }


        return view('lista-consultas-pacientes')->with(['collection'=>$collection,'paginate'=>$paginate,'nome_medico'=>$nomeMedico,'nome_clinica'=>$nomeClinica,'status_consulta'=>$statusConsulta,'data_hoje'=>$dataHoje?1:0,'perfil'=>'paciente']);

    }

    public function salvarCancelamento($id){
        $consulta =  $this->consulta->find($id);

        $motivo = "Data de consulta: ".$consulta->agendamento->data_agendamento.". Medico: ".$consulta->agendamento->vinculo->registroRegional->medico->usuario->nome.". Justificativa: Cancelado pelo Paciente";


        $consulta->status = Consulta::CANCELADO;

        $consulta->justificativa = $motivo;
        $agendamento = $this->agendamento->find($consulta->agendamento_id);
        $consulta->agendamento_id = null;
        if($consulta->retorno_id!=null){
            $consulta->retorno_id = null;
        }
        $consulta->save();
        $agendamento->delete();

        return redirect()->action("ConsultasPacienteController@listar")->with(["msgCancelamento"=>"success"]);



    }
    //---------------------------Getters e Setters------------------------------//

}
