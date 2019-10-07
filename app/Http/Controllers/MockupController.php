<?php

namespace Infoclinic\Http\Controllers;

use Illuminate\Http\Request;

class MockupController extends Controller
{
    public function agendamentoMedico(){
        return view("mockups.agendamento-medico");
    }

    public function consulta(){
        return view("mockups.consulta");
    }
}
