<div class="card">
	<div class="card-header text-white bg-info"><i class="fa fa-users-cog"></i> Escolha seu perfil</div>
	<div class="card-body">
		<div class="nav flex-column nav-pills">
			 @if(Auth::user()->clinica_id!=null)
			 	<a class="nav-link {{$perfil=='clinica'?'active':''}}" href="/clinica"><i class="{{$perfil=='clinica'?'far fa-arrow-alt-circle-down':'far fa-arrow-alt-circle-right'}}"></i> Clínica</a>
			 @endif			 
			 @if(Auth::user()->paciente_id!=null)
			 	<a class="nav-link {{$perfil=="paciente"?'active':''}}" href="/paciente"><i class="{{$perfil=='paciente'?'far fa-arrow-alt-circle-down':'far fa-arrow-alt-circle-right'}}"></i> Paciente</a>
			 @endif
			 @if(Auth::user()->atendente_id!=null)
			 	<a class="nav-link {{$perfil=="atendente"?'active':''}}" href="/atendente"><i class="{{$perfil=='atendente'?'far fa-arrow-alt-circle-down':'far fa-arrow-alt-circle-right'}}"></i> Atendente</a>
			 @endif
			 @if(Auth::user()->medico_id!=null)
			 	<a class="nav-link {{$perfil=="medico"?'active':''}}" href="/medico"><i class="{{$perfil=='medico'?'far fa-arrow-alt-circle-down':'far fa-arrow-alt-circle-right'}}"></i> Médico</a>
			 @endif
			 @if(Auth::user()->administrador_id!=null)
			 	<a class="nav-link {{$perfil=="administrador"?'active':''}}" href="/administrador"><i class="{{$perfil=='administrador'?'far fa-arrow-alt-circle-down':'far fa-arrow-alt-circle-right'}}"></i> Administrador</a>
			 @endif
		</div>
	</div>
</div>