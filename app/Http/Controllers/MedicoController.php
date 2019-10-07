<?php namespace Infoclinic\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Infoclinic\Http\Requests;
use Infoclinic\Http\Controllers\Controller;
use Infoclinic\Http\Requests\UserRequest;
use Infoclinic\Model\Consulta;
use Infoclinic\Model\Paciente;
use Infoclinic\User;
use Infoclinic\Model\Medico;
use http\Env\Response;
use Illuminate\Support\Facades\DB;
use Infoclinic\Validation\Validation;
use Illuminate\Http\Request;

class MedicoController extends Controller {
	public function index(){
        $minDate = Carbon::today();
        $maxDate = Carbon::today();

        $minDate->hour = 0;
        $maxDate->hour = 23;
        $minDate->minute = 0;
        $maxDate->minute = 59;

        $consultas =  Consulta::join('agendamentos','agendamentos.id','=','consultas.agendamento_id')
            ->join('vinculos','vinculos.id','=','agendamentos.vinculo_id')
            ->join('registros_regional','vinculos.registro_id','=','registros_regional.id')
            ->where('registros_regional.medico_id', Auth::user()->medico->id)
            ->where('consultas.status',Consulta::AGUARDANDO)
            ->where('agendamentos.data_agendamento','>=',$minDate)
            ->where('agendamentos.data_agendamento','<=',$maxDate)
            ->get();

        return view("medico")->with(['consultas'=>$consultas]);
	}
	public function permitir($id){
	    $usuario = User::find($id);
	    $medico = new Medico();
	    $medico->save();
	    $usuario->medico_id = $medico->id;
	    $usuario->save();
        return back()->with(['paciente'=>$usuario->paciente,'msgPermitir'=>'success']);
    }
    public function listar(Request $request){
        $consulta = $request->get('consulta',null);
        $paginate = $request->get('paginate',5);
        $medicos = Medico::join('usuarios','usuarios.medico_id','=','medicos.id')
            ->join('pacientes','usuarios.paciente_id','=','pacientes.id')
            ->select('usuarios.id as usuario_id','usuarios.*','pacientes.*','medicos.*');
        if($consulta!=null){
            $medicos = $medicos->where('pacientes.cpf',$consulta);
        }
        $usuario = new User();
        $navbar = $usuario->escolherNavbar($request);
        return view('lista-medico')->with(['labelConsulta'=>'CPF','navbar'=>$navbar,'collection'=>$medicos->paginate($paginate),'paginate'=>$paginate,'consulta'=>$consulta]);
    }
    public function novo(Request $request){
	    $usuario = new User();
	    $navbar = $usuario->escolherNavbar($request);
	    return view('novo-medico')->with(['navbar'=>$navbar,'path'=>$request->path()]);
    }
    public function cadastrar(UserRequest $request){
        $usuario =  new User($request->except('password'));
        if(Validation::validarCPF($request->cpf)){
            Paciente::create($request->all());
            $paciente =  DB::table('pacientes')->latest()->first();
            $medico = new Medico();
            $medico->save();
            $usuario->medico_id = $medico->id;
            $usuario->paciente_id = $paciente->id;
            $usuario->password=bcrypt("123mudar");
            $usuario->save();
            if(strpos($request['ultimaRequest'],'administrador/medico/')!==false){
                return redirect('/administrador/medico/listar')->with(['usuario'=>$usuario,'msgNovoAten'=>'success']);
            }else{
                return redirect('/clinica/medico/listar')->with(['usuario'=>$usuario,'msgNovoAten'=>'success']);
            }
        }else{
            return back()->with(["validarCpf"=>"error"])->withInput($request->all());
        }

    }
    public function status($id){
        $row = Medico::find($id);
        if($row->bloqueado==0){
            $row->bloqueado=1;
        }else{
            $row->bloqueado=0;
        }
        $row->update();
        return redirect()->action('MedicoController@listar');
    }

}
