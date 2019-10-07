<?php

namespace Infoclinic\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Infoclinic\Http\Requests\ExameRequest;
use Infoclinic\Model\Exame;
use Infoclinic\Model\LinhasProntuario;
use Symfony\Component\VarDumper\VarDumper;

class ExameController extends Controller
{
    private $exame;
    private $linhasProntuario;
    //--------------------------------Magicos-----------------------------------//
    public function __construct(Exame $exame, LinhasProntuario $linhasProntuario)
    {

        $this->exame = $exame;
        $this->linhasProntuario = $linhasProntuario;

    }

    //--------------------------------Privados----------------------------------//

    //--------------------------------Publicos----------------------------------//

    public function listar(Request $request){
        $consulta = $request->get('consulta',null);
        $paginate = $request->get('paginate',5);

        $exames = $this->exame->join('linhas_prontuario','exames.id','=','linhas_prontuario.exame_id')
            ->join('pacientes','linhas_prontuario.paciente_id','=','pacientes.id')
            ->where('pacientes.id',Auth::user()->paciente_id)
            ->select('exames.descricao','exames.id as id_exame','linhas_prontuario.bloqueado','linhas_prontuario.id as id_prontuario','exames.nome_arquivo','exames.created_at');

        if($consulta!=null){
            $exames->where('exames.descricao','like','%'.$consulta.'%');
        }

        return view('lista-exames')->with(['labelConsulta'=>'Descrição','collection'=>$exames->paginate($paginate),'paginate'=>$paginate,'consulta'=>$consulta]);


    }


    public function novo(){
        return view('novo-exame');
    }

    public function cadastrar(ExameRequest $request){
        $descricao = $request->get('descricao');
        $exame = new $this->exame(['descricao'=>$descricao]);

        $exame->save();

        if($request->file('arquivo')){
            $arquivo = $exame->id.'.'.$request->file('arquivo')->getClientOriginalExtension();

            $request->file('arquivo')->storeAs('public/exames',$arquivo);

            $exame->nome_arquivo = $arquivo;

            $exame->save();
        }

        $linhaProntuario = new $this->linhasProntuario(['paciente_id'=>Auth::user()->paciente_id,'exame_id'=>$exame->id,'bloqueado'=>0]);

        $linhaProntuario->save();


        return redirect()->action("ExameController@listar")->with(['msgNovoExame'=>'success']);

    }

    public function status($id){
        $linhaProntuario = $this->linhasProntuario->find($id);
        if($linhaProntuario->bloqueado==0){
            $linhaProntuario->bloqueado=1;
        }else{
            $linhaProntuario->bloqueado=0;
        }
        $linhaProntuario->update();
        return redirect()->action('ExameController@listar');
    }

    public function excluir($id){
        $exame = $this->exame->find($id);
        $linhaProntuario = $this->linhasProntuario->where('exame_id',$exame->id)->first();

        $linhaProntuario->delete();
        $exame->delete();

        return redirect()->action('ExameController@listar')->with(['msgExcluirExame'=>'success']);
    }



    //---------------------------Getters e Setters------------------------------//
}
