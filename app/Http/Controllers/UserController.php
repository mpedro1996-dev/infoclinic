<?php namespace Infoclinic\Http\Controllers;

use Infoclinic\Http\Requests;
use Infoclinic\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Infoclinic\Http\Requests\UserRequest;
use Infoclinic\User;
use Infoclinic\Model\Paciente;
use Infoclinic\Model\Clinica;
use Infoclinic\Model\Atendente;
use Infoclinic\Model\Medico;
use Infoclinic\Validation\Validation;

class UserController extends Controller {
    public function __construct(){
        $this->middleware('auth');
    }
    public function editar(Request $request,$id){
        $usuario = User::find($id);
        $navbar = $usuario->escolherNavbar($request);
        return view('usuario-editar')->with(['usuario'=>$usuario,'navbar'=>$navbar,'path'=>$request->path()]);
    }
    public function editado(UserRequest $request){
        $usuario = User::find($request->input('id'));
        if($usuario->paciente_id!=0){
            $paciente = Paciente::find($usuario->paciente_id);
            $paciente->update($request->all());

        }
        if($usuario->clinica_id!=null){
            $clinica = Clinica::find($usuario->clinica_id);
            $clinica->domingo = $request->has('domingo')?1:0;
            $clinica->segunda = $request->has('segunda')?1:0;
            $clinica->terca = $request->has('terca')?1:0;
            $clinica->quarta = $request->has('quarta')?1:0;
            $clinica->quinta = $request->has('quinta')?1:0;
            $clinica->sexta = $request->has('sexta')?1:0;
            $clinica->sabado = $request->has('sabado')?1:0;
            $clinica->update($request->all());
        }
        if($usuario->atendente_id!=0){

        }
        if($usuario->medico_id!=0){

        }
        $ultimaRequest=$request->input('ultimaRequest');
        $usuario->update($request->all());
        return $usuario->escolherRedirect($ultimaRequest,$usuario);
    }
    public function trocarSenha(UserRequest $request){
        $usuario = User::find($request->input('id'));
        $usuario->password = bcrypt($request->input('password'));
        $usuario->update();
        $usuario = User::find($request->input('id'));
        return redirect()->action("HomeController@index")->with(['msgUsuario'=>'success','usuario'=>$usuario]);

    }
    public function visualizar(Request $request,$id){
        $usuario = User::find($id);
        $navbar = $usuario->escolherNavbar($request);
        return view('usuario-visualizar')->with(['usuario'=>$usuario,'navbar'=>$navbar,'path'=>$request->path()]);
    }
    public function preCadastro(Request $request){
        $usuario = new User();
        $navbar = $usuario->escolherNavbar($request);
        $clinicas = Clinica::all();
        return view('pre-cadastro')->with(['usuario'=>$usuario,'navbar'=>$navbar,'path'=>$request->path(),'clinicas'=>$clinicas]);
    }
    public function verificarCpf(Request $request){
        if(Validation::validarCPF($request->input('cpf'))){
            $paciente = Paciente::where('cpf','=',$request['cpf']);
            if($paciente->get()->count()>0) {
                $pacienteId = $paciente->get()->toArray()[0]['id'];
                $paciente = Paciente::find($pacienteId);
            }else{
                return redirect('/'.$request->input('ultimaRequest'))->with(['msg404'=>'success']);
            }
            return redirect('/'.$request->input('ultimaRequest'))->with(['paciente'=>$paciente,'msgPosUser'=>'success']);
        }else{
            return redirect('/'.$request->input('ultimaRequest'))->with(['validarCpf'=>'success']);
        }
    }
}
