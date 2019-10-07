<?php

namespace Infoclinic\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Infoclinic\Model\Consulta;
use Infoclinic\Model\Prescricao;
use Symfony\Component\VarDumper\VarDumper;

class AgendaMedicoController extends Controller
{
    private $consulta;
    //--------------------------------Magicos-----------------------------------//
    public function __construct(Consulta $consulta)
    {
        $this->consulta = $consulta;

    }
    //--------------------------------Privados----------------------------------//

    //--------------------------------Publicos----------------------------------//

    public function listar(Request $request){
        $nomeClinica    = $request->get('nome_clinica',null);
        $statusConsulta = $request->get('status_consulta',Consulta::AGUARDANDO);
        $dataHoje       = $request->get('data_hoje',null)?true:false;

        $paginate = $request->get('paginate',5);


        $consultas = $this->consulta->join('pacientes','pacientes.id','=','consultas.paciente_id')
            ->join('agendamentos','agendamentos.id','=','consultas.agendamento_id')
            ->join('vinculos','agendamentos.vinculo_id','=','vinculos.id')
            ->join('registros_regional','vinculos.registro_id','=','registros_regional.id')
            ->join('medicos','medicos.id','=','registros_regional.medico_id')
            ->join('usuarios as usuarioMedico','usuarioMedico.medico_id','=','medicos.id')
            ->join('usuarios as usuarioPaciente','usuarioPaciente.paciente_id','=','pacientes.id')
            ->join('clinicas','vinculos.clinica_id','=','clinicas.id')
            ->join('especialidades','especialidades.id','=','consultas.especialidade_id')
            ->select('consultas.id as id_consulta','pacientes.id as id_paciente','usuarioPaciente.nome as nomePaciente','especialidades.nome as nomeEspecialidade','clinicas.razao_social','agendamentos.data_agendamento','consultas.status')
            ->where('medicos.id',Auth::user()->medico_id)
            ->orderBy('agendamentos.data_agendamento','asc');

        if($nomeClinica!=null){
            $consultas->where('clinicas.razao_social','like','%'.$nomeClinica.'%');
        }
        if($statusConsulta!=null){
            $consultas->where('consultas.status',$statusConsulta);
        }
        if($dataHoje==true){
            $hoje = Carbon::today();
            $consultas->whereDate('agendamentos.data_agendamento',$hoje->toDateString());
        }

        $collection = $consultas->paginate($paginate);
        foreach ($collection as $c){
            $prescricoes = Prescricao::where('consulta_id',$c->id_consulta)->get();
            if(count($prescricoes)>0){
                $c->prescricao = 1;
            }else{
                $c->prescricao = 0;
            }
        }


        return view('lista-consultas-medicos')->with(['collection'=>$collection,'paginate'=>$paginate,'nome_clinica'=>$nomeClinica,'status_consulta'=>$statusConsulta,'data_hoje'=>$dataHoje?1:0]);

    }

    public function abrirConsulta($id){
        $consulta = $this->consulta->find($id);
        if($consulta->status==Consulta::AGUARDANDO){

            return view('consulta')->with(['consulta'=>$consulta]);
        }else{
            return view('acesso-negado');
        }
    }

    public function pdf($id){
        $consulta = $this->consulta->find($id);
        $prescricoes = $consulta->prescricoes;
        $clinica = $consulta->agendamento->vinculo->clinica;
        $medico = $consulta->agendamento->vinculo->registroRegional->medico;
        $registro = $consulta->agendamento->vinculo->registroRegional;

        return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdf.prescricao',['prescricoes'=>$prescricoes,'clinica'=>$clinica,'medico'=>$medico,'registro'=>$registro,'consulta'=>$consulta])->stream();

    }

    //---------------------------Getters e Setters------------------------------//
}
