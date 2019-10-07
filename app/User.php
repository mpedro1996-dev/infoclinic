<?php namespace Infoclinic;

use Infoclinic\Model\Administrador;
use Infoclinic\Model\Atendente;
use Infoclinic\Model\Clinica;
use Infoclinic\Model\Medico;
use Infoclinic\Model\Paciente;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'usuarios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nome','telefone','celular','rg','data_nascimento',
        'cep','logradouro','numero','bairro','complemento','cidade','estado',
        'paciente_id','clinica_id','medico_id','atendente_id','administrador_id',
        'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function paciente(){
        return $this->belongsTo(Paciente::class);
    }
    public function administrador(){
        return $this->belongsTo(Administrador::class);
    }
    public function clinica(){
        return $this->belongsTo(Clinica::class);
    }
    public function atendente(){
        return $this->belongsTo(Atendente::class);
    }
    public function medico(){
        return $this->belongsTo(Medico::class);
    }


    public function escolherNavbar($request){
        if($request->is("administrador/*")){
            $navbar="administrador";
        }elseif($request->is("paciente/*")){
            $navbar="paciente";
        }elseif($request->is("medico/*")){
            $navbar="medico";
        }elseif($request->is("atendente/*")){
            $navbar="atendente";
        }elseif($request->is("clinica/*")){
            $navbar="clinica";
        }else{
            $navbar="principal";
        }
        return $navbar;
    }
    public function escolherRedirect($ultimaRequest,$usuario){
        if(strpos($ultimaRequest,"administrador/")!==false){
            if(strpos($ultimaRequest,"administrador/paciente/")!==false){
                return redirect()->action("PacienteController@listar")->with(['msgUsuario'=>'success','usuario'=>$usuario]);
            }
            if(strpos($ultimaRequest,"administrador/atendente/")!==false){
                return redirect('/administrador/atendente/listar')->with(['msgUsuario'=>'success','usuario'=>$usuario]);
            }
            if(strpos($ultimaRequest,"administrador/medico/")!==false){
                return redirect('/administrador/medico/listar')->with(['msgUsuario'=>'success','usuario'=>$usuario]);
            }
            if(strpos($ultimaRequest,"administrador/clinica/")!==false){
                return redirect()->with(['msgUsuario'=>'success','usuario'=>$usuario]);
            }else{
                return redirect()->action("AdministradorController@listar")->with(['msgUsuario'=>'success','usuario'=>$usuario]);
            }
        }if(strpos($ultimaRequest,"paciente/")!==false){
            return redirect()->action("PacienteController@index")->with(['msgUsuario'=>'success','usuario'=>$usuario]);
        }if(strpos($ultimaRequest,"clinica/")!==false){
            return redirect()->action("ClinicaController@index")->with(['msgUsuario'=>'success','usuario'=>$usuario]);
        }if(strpos($ultimaRequest,"atendente/")!==false){
            return redirect()->action("AtendenteController@index")->with(['msgUsuario'=>'success','usuario'=>$usuario]);
        }if(strpos($ultimaRequest,"medico/")!==false){
            return redirect()->action("MedicoController@index")->with(['msgUsuario'=>'success','usuario'=>$usuario]);
        }if(strpos($ultimaRequest,'clinica/atendente')!==false){
            return redirect('/clinica/atendente/listar')->with(['msgUsuario'=>'success','usuario'=>$usuario]);
        }else{
            return redirect()->action("HomeController@index")->with(['msgUsuario'=>'success','usuario'=>$usuario]);
        }
    }

}
