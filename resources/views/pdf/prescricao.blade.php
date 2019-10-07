<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

</head>
<style>
    html{
        font-family: Arial, Sans-serif;
    }

    .conteudo{
        margin-top: 10px;
        margin-bottom: 10px;
    }
    .container{
        margin: 0 auto;
    }
    .img-logo{
        width: 100%;
        max-width: 200px;
    }

    .col{
        float: left;
    }
    .clearfix{
        clear: both;
    }
    .no-margin{
        margin-bottom: 0;
        margin-top: 0;
    }
    .small-size{
        font-size:10px;
    }
    .assinatura{
        width: 60%;
        text-align: center;
        margin: 100px auto 20px;
    }
    .data-agendamento{
        text-align: right;
    }

    .cl-blue{
        color:#0A246A;
    }
    .divisor{
        height:5px;
        background-color: #0A246A;
        color:#0A246A;
    }
    .hr-assinatura{
        border-top: 1px dashed #0A246A;
        border-bottom: 0;
    }






</style>
<body>
<div class="topo">
    <div class="col" style="width: 20%;">
        <img class="img-logo" src="{{public_path("img/logo.png")}}">
    </div>
    <div class="col" style="width: 80%; text-align: center">
        <h3 class="no-margin cl-blue">{{$clinica->razao_social}}</h3>
        <p class="no-margin small-size">Endereço:{{$clinica->logradouro_clinica}}, nº: {{$clinica->numero_clinica}}</p>
        <p class="no-margin small-size">Bairro:{{$clinica->bairro_clinica}}, {{$clinica->cidade_clinica}} - {{$clinica->estado_clinica}}</p>
        <p class="no-margin small-size">CNPJ: {{$clinica->cnpj}}</p>
    </div>
</div>
<div class="clearfix"></div>
<div class="container">
    <div class="conteudo">
        <h2 class="cl-blue">Receituário</h2>
        <ul style="list-style-type:none ">
            @foreach($prescricoes as $key=>$p)
                <li>{{($key+1)}}) <b>Medicamento:</b> {{$p->nome_remedio}}
                    <ul>
                        <li><b>Quantidade e Forma Farmacêutica:</b> {{$p->quantidade}} {{$p->unidade_medida}}</li>
                        <li><b>Posologia:</b> {{$p->periodo}}</li>
                    </ul>
                    <br>
                </li>
            @endforeach
        </ul>
    </div>
    <hr class="divisor">
    <h3 class="cl-blue">Assinatura e Carimbo</h3>
    <div class="assinatura">
        <hr class="hr-assinatura">
        <p>{{$medico->usuario->nome}}</p>
        <p><b>{{$registro->tipo_registro}}:</b> {{$registro->numero}} - {{$registro->estado->uf}}</p>
    </div>
    <div class="data-agendamento">
        <p><b>Data da Consulta:</b> {{date('d/m/Y H:i', strtotime($consulta->agendamento->data_agendamento))}}</p>

    </div>
</div>

</body>
</html>