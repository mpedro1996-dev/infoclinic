<?php

namespace Infoclinic\Http\Controllers\Auth;

use Carbon\Carbon;
use Infoclinic\Model\Paciente;
use Infoclinic\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Infoclinic\User;
use Infoclinic\Validation\Validation;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $message = [
            'unique:usuarios'=>':attribute já existente.',
            'cpf.required'=>'O campo CPF deve ser preenchido.',
            'nome.required'=>'O campo Nome deve ser preenchido.',
            'telefone.required'=>'O campo Telefone deve ser preenchido.',
            'celular.required'=>'O campo Celular deve ser preenchido.',
            'rg.required'=>'O campo RG deve preenchido.',
            'data_nascimento.required'=>'O campo Data de Nascimento deve ser preenchido.',
            'cep.required'=>'O campo CEP deve possuir deve ser preenchido.',
            'logradouro.required'=>'O campo Logradouro deve ser preenchido.',
            'numero.required'=>'O campo Número deve ser preenchido.',
            'bairro.required'=>'O campo Bairro deve ser preenchido.',
            'cidade.required'=>'O campo Cidade deve ser preenchido.',
            'estado.required'=>'O campo Estado deve ser preenchido.',
            'email.required'=>'O campo E-mail deve ser preenchido.',
            'tipo_sanguineo.max'=>'O campo Tipo Sanguíneo deve ser preenchido.',
            'fator_rh.max'=>'O campo Fator RH deve ser preenchido.',
            'sexo.required'=>'O campo Sexo deve ser preenchido.',
            'estado_civil.required'=>'O campo Estado Civil deve ser preenchido.',
            'peso.required'=>'O campo Peso deve ser preenchido.',
            'altura.required'=>'O campo Altura deve ser preenchido.',
            'data_nascimento.before'=>'A data de nascimento tem que ser anterior a hoje.',


            'nome.max'=>'O campo Nome deve possuir no máximo 100 caracteres.',
            'telefone.max'=>'O campo Telefone deve possuir no máximo 13 caracteres.',
            'celular.max'=>'O campo Celular deve possuir no máximo 14 caracteres.',
            'rg.max'=>'O campo RG deve possuir no máximo 20 caracteres.',
            'data_nascimento.max'=>'O campo Data de Nascimento deve ter no máximo 10 caracteres.',
            'cep.max'=>'O campo CEP deve possuir no máximo 9 caracteres.',
            'logradouro.max'=>'O campo Logradouro deve possuir no máximo 100 caracteres.',
            'numero.max'=>'O campo Número deve possuir no máximo 10 caracteres.',
            'bairro.max'=>'O campo Bairro deve possuir no máximo 80 caracteres.',
            'complemento.max'=>'O campo Complemento deve possuir no máximo 100 caracteres.',
            'cidade.max'=>'O campo Cidade deve possuir no máximo 40 caracteres.',
            'estado.max'=>'O campo Estado deve possuir no máximo 2 caracteres.',
            'email.max'=>'O campo E-mail deve possuir no máximo 100 caracteres.',
            'email.unique'=>'O E-mail já está em uso.',
            'password.required'=>'O campo Senha deve ser preenchido.',
            'password.confirmed'=>'O campo Senha deve ser confirmado.',
            'password.min'=>'O campo Senha deve possuir no mínimo 6 caracteres.',
            'altura.min'=>'Altura não pode ser negativa.',
            'peso.min'=>'Peso não pode ser negativo.',
        ];
        return Validator::make($data, [
            'nome' => 'sometimes|required|max:100',
            'telefone'=>'sometimes|required|max:13',
            'celular'=>'sometimes|required|max:14',
            'rg'=>'required|max:20',
            'data_nascimento'=>'required|max:10|before:'.Carbon::today(),
            'cep'=>'sometimes|required|max:9',
            'logradouro'=>'sometimes|required|max:100',
            'numero'=>'sometimes|required|max:10',
            'bairro'=>'sometimes|required|max:80',
            'complemento'=>'max:100',
            'cidade'=>'sometimes|required|max:40',
            'estado'=>'sometimes|required|max:2',
            'email' => 'sometimes|required|email|max:100|unique:usuarios,email',
            'cpf'=>['required','unique:pacientes,cpf',function($attribute,$value,$fail){
                if(!Validation::validarCPF($value)){
                    $fail('CPF não é válido.');
                }
            }],
            'tipo_sanguineo'=>'max:2',
            'fator_rh'=>'max:1',
            'sexo'=>'required',
            'estado_civil'=>'required',
            'peso'=>'numeric|min:0.01|required',
            'altura'=>'numeric|min:0.01|required',
            'password' => 'required|confirmed|min:6',


        ],$message);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \Infoclinic\User
     */
    protected function create(array $data)
    {
        $paciente = Paciente::create(['cpf'=>$data['cpf'],'tipo_sanguineo'=>$data['tipo_sanguineo'],'fator_rh'=>$data['fator_rh'],'sexo'=>$data['sexo'],'estado_civil'=>$data['estado_civil'],'peso'=>$data['peso'],'altura'=>$data['altura']]);
        return User::create([
            'nome' => $data['nome'],
            'telefone'=>$data['telefone'],
            'celular'=>$data['celular'],
            'rg'=>$data['rg'],
            'data_nascimento'=>$data['data_nascimento'],
            'cep'=>$data['cep'],
            'logradouro'=>$data['logradouro'],
            'numero'=>$data['numero'],
            'bairro'=>$data['bairro'],
            'complemento'=>$data['complemento'],
            'cidade'=>$data['cidade'],
            'estado'=>$data['estado'],
            'paciente_id'=>$paciente->id,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
