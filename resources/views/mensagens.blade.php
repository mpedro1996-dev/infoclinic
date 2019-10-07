@if(session('msgNovoAdmin'))
	<div class="text-success">Novo Administrador cadastrado com sucesso</div>
@endif
@if(session('msgNovoMedico'))
	<div class="text-success">Novo Medico cadastrado com sucesso</div>
@endif
@if(session('msgNovaClinica'))
	<div class="text-success">Nova Clínica cadastrada com sucesso</div>
@endif
@if(session('msgPermitir'))
	<div class="text-success">Perfil atribuido ao usuário com sucesso</div>
@endif
@if(session('msgUsuario'))
	@if(Auth::user()->id!=session('usuario')->id)
		<div class="text-success">Usuário {{session('usuario')->nome}} atualizado com sucesso</div>
	@else
		<div class="text-success">Dados Cadastrados Atualizado</div>
	@endif
@endif
@if(session('msgPosUser'))
	<p class="text-success">Paciente encontrado para atribuição de perfil</p>
@endif
@if(session('msgNovoRegistro'))
	<p class="text-success">Registro Regional cadastrado com sucesso</p>
@endif
@if(session('msgVincular'))
	<p class="text-success">Médico Vinculado a clinica com sucesso.</p>
@endif
@if(session('msgDesvincular'))
	<p class="text-success">Médico Desvinculado da clinica com sucesso.</p>
@endif
@if(session('msgDiaAtendimento'))
	<p class="text-success">Dia de Atendimento cadastrado/alterado com sucesso.</p>
@endif
@if(session('msgExcluirDiaAtendimento'))
	<p class="text-success">Dia de Atendimento excluido com sucesso.</p>
@endif
@if(session('msgNovoExame'))
	<p class="text-success">Exame cadastrado com sucesso</p>
@endif
@if(session('msgExcluirExame'))
	<p class="text-success">Exame deletado com sucesso</p>
@endif
@if(session('msgStatusConsulta'))
	<p class="text-success">A Consulta foi passada para fila de atendimento com sucesso</p>
@endif
@if(session('msgCancelamento'))
	<p class="text-success">Consulta cancelada com sucesso</p>
@endif
@if(session('msgFechamentoConsulta'))
	@if(session('consulta_id')==null)
		<p class="text-success">Consulta fechada com sucesso</p>
	@else
		<p class="text-info">Consulta fechada com sucesso. Clique <a href="/medico/consultas/prescricao/pdf/{{session('consulta_id')}}" class="btn btn-link">aqui</a> para imprimir a prescrição</p>
	@endif
@endif

@if(session('msgCadastroRetorno'))
	<p class="text-success">Consulta de retorno marcada com sucesso</p>
@endif


@if(session('msgFalta'))
	<p class="text-success">Falta cadastrada com sucesso</p>
@endif




