<?php namespace Infoclinic\Http\Controllers;

use Infoclinic\Model\Clinica;
use Infoclinic\Model\Especialidade;
use Infoclinic\Model\Medico;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('welcome');
	}

	public function especialidades(){
	    $especialidades = Especialidade::all();
	    return view("home_especialidade")->with(["especialidades"=>$especialidades]);
    }

    public function clinicas(){
	    $clinicas = Clinica::all();
	    return view("home_clinica")->with(["clinicas"=>$clinicas]);
    }

    public function medicos(){
        $medicos = Medico::all();
        return view('home_medicos')->with(["medicos"=>$medicos]);
    }

}
