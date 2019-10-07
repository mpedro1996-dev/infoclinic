@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Tem problemas com sua entrada de dados:<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@elseif(session('validarCpf')||session('validarCnpj'))
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Tem problemas com sua entrada de dados:<br><br>
        <ul>
            @if(session('validarCpf'))
                <li>CPF está inválido</li>
            @endif
            @if(session('validarCnpj'))
                <li>CNPJ está inválido</li>
            @endif
        </ul>
    </div>
@elseif(session('horarioFuncErro'))
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Tem problemas com sua entrada de dados:<br><br>
        <ul>
            <li>O horário que começa o funcionamento da clínica deve ser mais cedo do horário que encerra o funcionamento da clínica</li>
        </ul>
    </div>
@elseif(session('msg404'))
    <p class="text-danger">Paciente não encontrado</p>
@elseif(session('msg404Especialidade'))
    <p class="text-danger">Não há vinculos com essa especialidade</p>
@elseif(session('erroVazio'))
    <p class="text-danger">Preencha os campos ou um dos campos necessários</p>
@endif