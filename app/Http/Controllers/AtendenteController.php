<?php namespace Infoclinic\Http\Controllers;

use Carbon\Carbon;
use Infoclinic\Http\Requests;
use Infoclinic\Http\Controllers\Controller;
use Infoclinic\Model\Consulta;
use Infoclinic\Model\Vinculo;
use Infoclinic\Validation\Validation;
use Infoclinic\Http\Requests\AtendentesRequest;
use Infoclinic\Model\Atendente;
use Infoclinic\User;
use Infoclinic\Model\Paciente;
use Infoclinic\Model\Clinica;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\VarDumper;

class AtendenteController extends Controller {
    public function index(){
        $minDate = Carbon::today();
        $maxDate = Carbon::today();

        $minDate->hour = 0;
        $maxDate->hour = 23;
        $minDate->minute = 0;
        $maxDate->minute = 59;


        $agendamentos =  Consulta::join('agendamentos','agendamentos.id','=','consultas.agendamento_id')
            ->join('vinculos','vinculos.id','=','agendamentos.vinculo_id')
            ->where('vinculos.clinica_id',Auth::user()->atendente->clinica_id)
            ->where('consultas.status',Consulta::AGENDADO)
            ->where('agendamentos.data_agendamento','>=',$minDate)
            ->where('agendamentos.data_agendamento','<=',$maxDate)
            ->limit(3)
            ->orderBy('agendamentos.data_agendamento','ASC')
            ->get();

        return view('atendente')->with(['consultas'=>$agendamentos]);
    }
    public function permitir(AtendentesRequest $request){
        $usuario = User::find($request->input('usuario-id'));
        if($request->input('cnpj')!=""||$request->input('carteira')!=""){
            if($request->input('cnpj')!=""){
                if(!Validation::validarCNPJ($request['cnpj'])){
                    return back()->with(['validarCnpj'=>'success','paciente'=>$usuario->paciente])->withInput($request->all());
                }
            }
            $atendente = Atendente::create($request->all());
            $usuario->atendente_id=$atendente->id;
            $usuario->save();
            return back()->with(['paciente'=>$usuario->paciente,'msgPermitir'=>'success']);
        }
        return back()->with(['paciente'=>$usuario->paciente,'erroVazio'=>'success']);
    }
    public function novo(Request $request){
        $clinicas = Clinica::all();
        $usuario = new User();
        $navbar = $usuario->escolherNavbar($request);
        return view('novo-atendente')->with(['usuario'=>$usuario,'navbar'=>$navbar,'path'=>$request->path(),'clinicas'=>$clinicas]);
    }
    public function cadastrar(AtendentesRequest $request){
        if($request->input('cnpj')!=""||$request->input('carteira')!=""){
            if($request->input('cnpj')!=""){
                if(!Validation::validarCNPJ($request['cnpj'])){
                    return back()->with(['validarCnpj'=>'success'])->withInput($request->all());
                }
            }
            if(!Validation::validarCPF($request['cpf'])){
                return back()->with(['validarCpf'=>'success'])->withInput($request->all());
            }
            $usuario = new User($request->except('password','clinica_id'));
            $usuario->password = bcrypt('123mudar');
            $paciente = Paciente::create($request->all());
            $atendente = Atendente::create($request->all());
            $usuario->paciente_id = $paciente->id;
            $usuario->atendente_id = $atendente->id;
            $usuario->save();
            if(strpos($request['ultimaRequest'],'administrador/atendente/')!==false){
                return redirect('/administrador/atendente/listar')->with(['usuario'=>$usuario,'msgNovoAten'=>'success']);
            }else{
                return redirect('/clinica/atendente/listar')->with(['usuario'=>$usuario,'msgNovoAten'=>'success']);
            }
        }
    }
    public function listar(Request $request){
        $consulta = $request->get('consulta',null);
        $paginate = $request->get('paginate',5);
        $atendentes = Atendente::join('usuarios','usuarios.atendente_id','=','atendentes.id')
            ->join('pacientes','pacientes.id','=','usuarios.paciente_id')
            ->join('clinicas','clinicas.id','=','atendentes.clinica_id')
            ->select('usuarios.id as usuario_id','atendentes.*','usuarios.*','pacientes.*','clinicas.*');
        if($request->is('clinica/*')){
            $atendentes = $atendentes->where('atendentes.clinica_id',Auth::user()->clinica_id);
        }
        if($consulta!=null){
            $atendentes = $atendentes->where('pacientes.cpf',$consulta);
        }
        $usuario = new User();
        $navbar = $usuario->escolherNavbar($request);
        return view('lista-atendente')->with(['labelConsulta'=>'CPF','navbar'=>$navbar,'collection'=>$atendentes->paginate($paginate),'paginate'=>$paginate,'consulta'=>$consulta]);

    }
    public function status($id){
        $atendente = Atendente::find($id);
        if($atendente->bloqueado==0){
            $atendente->bloqueado=1;
        }else{
            $atendente->bloqueado=0;
        }
        $atendente->update();
        return back();
    }

}
