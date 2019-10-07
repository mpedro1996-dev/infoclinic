<?php namespace Infoclinic\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AcessoMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {

        if($request->is('clinica*')){
            if(Auth::user()->clinica_id==null){
                return redirect('/acesso-negado');
            }
        }
        if($request->is('administrador*')){
            if(Auth::user()->administrador_id==null){
                return redirect('/acesso-negado');
            }
        }
        if($request->is('paciente*')){
            if(Auth::user()->paciente_id==null){
                return redirect('/acesso-negado');
            }
        }
        if($request->is('atendente*')){
            if(Auth::user()->atendente_id==null){
                return redirect('/acesso-negado');
            }
        }
        if($request->is('medico*')){
            if(Auth::user()->medico_id==null){
                return redirect('/acesso-negado');
            }
        }
        return $next($request);
    }

}
