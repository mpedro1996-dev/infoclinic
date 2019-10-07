<?php namespace Infoclinic\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Infoclinic\Http\Requests;
use Infoclinic\Http\Requests\UserRequest;
use Infoclinic\Http\Requests\ClinicasRequest;
use Infoclinic\Http\Controllers\Controller;
use Infoclinic\Model\Paciente;
use Infoclinic\Model\Vinculo;
use Infoclinic\User;
use Infoclinic\Model\Clinica;
use Illuminate\Support\Facades\DB;
use Infoclinic\Validation\Validation;


use Illuminate\Http\Request;

class ClinicaController extends Controller {
	public function index(){
	    $vinculos = Vinculo::where('clinica_id',Auth::user()->clinica->id)
            ->orderBy('created_at','DESC')
            ->limit(3)
            ->get();

		return view('clinica')->with(['vinculos'=>$vinculos]);
	}
	public function listar(Request $request){
        $consulta = $request->get('consulta',null);
        $paginate = $request->get('paginate',5);
        $clinicas =  Clinica::join('usuarios','usuarios.clinica_id','=','clinicas.id')
        ->select('usuarios.id as usuario_id','usuarios.*','clinicas.*');
        if($consulta!=null){
            $clinicas = $clinicas->where('cpnj',$consulta);
        }

		return view('lista-clinica')->with(['labelConsulta'=>'CNPJ','collection'=>$clinicas->paginate($paginate),'paginate'=>$paginate,'consulta'=>$consulta]);
	}
	public function permitir(ClinicasRequest $request){
        $usuario = User::find($request->input('usuario-id'));
	    if(Validation::validarCNPJ($request->input('cnpj'))){
            $clinica = Clinica::create($request->all());
            $usuario->clinica_id = $clinica->id;
            $usuario->save();
            return back()->with(['paciente'=>$usuario->paciente,'msgPermitir'=>'success']);
        }else{
            return back()->with(['paciente'=>$usuario->paciente,'validarCnpj'=>'success'])->withInput($request->only(['cnpj','razao_social']));
        }

    }
	public function novo(){
		return view('nova-clinica');
	}
	public function cadastrar(ClinicasRequest $request){
		if($request->input('horarioInicioFunc')<$request->input('horarioFimFunc')){			
			$usuario = new User($request->except('password','administrador_id'));
			if(Validation::validarCNPJ($request->input('cnpj'))){
			    $paciente = Paciente::create($request->all());
				$clinica = Clinica::create($request->all());
				$usuario->clinica_id = $clinica->id;
				$usuario->paciente_id = $paciente->id;
				$usuario->password=bcrypt("123mudar");				
				$usuario->save();		
				return redirect()->action("ClinicaController@listar")->with(['msgNovaClinica'=>'success']);
			}else{
				return redirect()->action("ClinicaController@novo")->with(["validarCpf"=>"erro"])->withInput($request->all());
			}
		}else{
			return redirect()->action("ClinicaController@novo")->with(["horarioFuncErro"=>"erro"])->withInput($request->all());
		}	
	}
    public function status($id){
        $clinica = Clinica::find($id);
        if($clinica->bloqueado==0){
            $clinica->bloqueado=1;
        }else{
            $clinica->bloqueado=0;
        }
        $clinica->update();
        return redirect()->action('ClinicaController@listar');
    }

}
