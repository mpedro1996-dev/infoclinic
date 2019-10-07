<?php namespace Infoclinic\Http\Controllers;

use Infoclinic\Model\Especialidade;
use Infoclinic\Model\Estado;
use Infoclinic\Http\Requests;
use Infoclinic\Http\Controllers\Controller;
use Infoclinic\Http\Requests\RegistroRegionalRequest;
use Infoclinic\Model\Medico;
use Infoclinic\Model\RegistroRegional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\VarDumper;

class RegistroRegionalController extends Controller {
	private $registroRegional;
	private $estados;
	private $especialidades;
	private $medicos;
    public function __construct(RegistroRegional $registroRegional,
                                Estado $estados,
                                Especialidade $especialidades,
                                Medico $medicos)
    {
        $this->registroRegional = $registroRegional;
        $this->estados = $estados;
        $this->especialidades = $especialidades;
        $this->medicos=$medicos;
    }
    public function listar(Request $request){
        $consulta = $request->get('consulta',null);
        $paginate = $request->get('paginate',5);
        $collection = $this->registroRegional
            ->join('estados','estados.id','=','registros_regional.estado_id')
            ->join('medicos','medicos.id','=','registros_regional.medico_id')
            ->join('usuarios','usuarios.medico_id','=','medicos.id')
            ->leftJoin('vinculos','vinculos.registro_id','=','registros_regional.id')
            ->whereNull('vinculos.id')
            ->where('estados.uf','=',Auth::user()->clinica->estado_clinica)
            ->select('usuarios.nome as nome_medico','registros_regional.*','estados.uf');
        if($consulta!=null){
            $collection = $collection->where('usuarios.nome','like','%'.$consulta.'%');
        }
        return view('conselhos-regionais')->with(['collection'=>$collection->paginate($paginate),'estados'=>$this->estados->all(),'especialidades'=>$this->especialidades->all(),'labelConsulta'=>'Nome','paginate'=>$paginate,'consulta'=>$consulta]);
    }
    public function meusRegistros(Request $request){
        $paginate = $request->get('paginate',5);
        $collection = $this->registroRegional->where('medico_id',Auth::user()->medico_id);
        return view('lista-conselhos-regionais')->with(['collection'=>$collection->paginate($paginate),'paginate'=>$paginate,'consulta'=>"",'especialidades'=>$this->especialidades->all()]);
    }
    public function  novo(){
        return view('novo-conselho-regional')->with(['medicos'=>$this->medicos->all(),'estados'=>$this->estados->all()]);
    }
    public function cadastrar(RegistroRegionalRequest $request){
        $row = new $this->registroRegional($request->all());
        $row->save();
        return redirect()->action('RegistroRegionalController@meusRegistros')->with(['msgNovoRegistro'=>'success']);
    }
    public function status($id){
        $row = $this->registroRegional->find($id);
        if($row->bloqueado==0){
            $row->bloqueado=1;
        }else{
            $row->bloqueado=0;
        }
        $row->save();
        return redirect()->action('RegistroRegionalController@meusRegistros')->with(['msgDeleteRegistro' => 'success', 'id' => $row->id]);
    }



}
