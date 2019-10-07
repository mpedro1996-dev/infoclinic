<?php namespace Infoclinic\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Infoclinic\Http\Requests;
use Infoclinic\Http\Controllers\Controller;

use Infoclinic\Model\Consulta;
use Infoclinic\Model\Paciente;
use Infoclinic\User;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\VarDumper;

class PacienteController extends Controller {
	public function index(){
	    $consultas = Consulta::where('paciente_id',Auth::user()->paciente->id)
            ->orderBy('consultas.created_at','DESC')
            ->where('consultas.status',1)
            ->limit(3)
            ->get();
	    foreach ($consultas as $c){
	        if($c->status == Consulta::AGENDADO){
	            $c->color = 'bg-primary';
            }
            if($c->status == Consulta::AGUARDANDO){
                $c->color = 'bg-info';
            }
            if($c->status == Consulta::FECHADO){
                $c->color = 'bg-dark';
            }
        }
	    return view('paciente')->with(['consultas'=>$consultas]);
	}
    public function listar(Request $request){
        $consulta = $request->get('consulta',null);
        $paginate = $request->get('paginate',5);
        $pacientes = Paciente::join('usuarios','usuarios.paciente_id','=','pacientes.id')
            ->select('usuarios.id as usuario_id','usuarios.*','pacientes.*');
        if($consulta!=null){
            $pacientes = $pacientes->where('pacientes.cpf',$consulta);
        }
        $usuario = new User();
        $navbar = $usuario->escolherNavbar($request);
        return view('lista-paciente')->with(['labelConsulta'=>'CPF','navbar'=>$navbar,'collection'=>$pacientes->paginate($paginate),'paginate'=>$paginate,'consulta'=>$consulta]);
    }
}
