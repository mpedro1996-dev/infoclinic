<?php namespace Infoclinic\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Infoclinic\Http\Requests;
use Infoclinic\Http\Controllers\Controller;
use Infoclinic\Http\Requests\UserRequest;
use Infoclinic\Model\Clinica;
use Infoclinic\User;
use Infoclinic\Model\Administrador;
use Infoclinic\Model\Paciente;
use Illuminate\Support\Facades\DB;
use Infoclinic\Validation\Validation;

use Illuminate\Http\Request;

class AdministradorController extends Controller {
	public function index(){
	    $clinicas = Clinica::where('administrador_id',Auth::user()->administrador->id)->orderBy('created_at','DESC')->limit(3)->get();
	    return view('administrador')->with(['clinicas'=>$clinicas]);
	}
	public function novo(){
		return view('novo-administrador');

	}
	public function cadastrar(UserRequest $request){
		$usuario =  new User($request->except('password'));			
		if(Validation::validarCPF($request->cpf)){
			Paciente::create($request->all());
			$paciente =  DB::table('pacientes')->latest()->first();
			$administrador = Administrador::create(['permissao_especial'=>0]);
			$usuario->administrador_id = $administrador->id;
			$usuario->paciente_id = $paciente->id;
			$usuario->password=bcrypt("123mudar");		
			$usuario->save();
			return redirect()->action('AdministradorController@listar')->with(["msgNovoAdmin"=>"success"]);
		}else{
			return redirect()->action('AdministradorController@novo')->with(["validarCpf"=>"error"])->withInput($request->all());
		}

	}
	public function permitir($id){
		$usuario = User::find($id);
        $administrador = Administrador::create(['permissao_especial'=>0]);
		$usuario->administrador_id= $administrador->id;
		$usuario->update();
		return back()->with(["msgPermitir"=>"success",'paciente'=>$usuario->paciente]);
	}
	public function listar(Request $request){
	    $consulta = $request->get('consulta',null);
        $paginate = $request->get('paginate',5);
	    $administradores = Administrador::join('usuarios','usuarios.administrador_id','=','administradores.id')
            ->join('pacientes','usuarios.paciente_id','=','pacientes.id')
            ->select('usuarios.id as usuario_id','usuarios.*','pacientes.*','administradores.*');
	    if($consulta!=null){
	        $administradores = $administradores->where('pacientes.cpf',$consulta);
	    }
	    return view('lista-administrador')->with(['labelConsulta'=>'CPF','collection'=>$administradores->paginate($paginate),'paginate'=>$paginate,'consulta'=>$consulta]);
	}
	public function status($id){
        $administrador = Administrador::find($id);
        if($administrador->bloqueado==0){
            $administrador->bloqueado=1;
        }else{
            $administrador->bloqueado=0;
        }
        $administrador->update();
        return redirect()->action('AdministradorController@listar');
    }
}
