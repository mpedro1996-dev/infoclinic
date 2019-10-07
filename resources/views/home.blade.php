@extends('app')
@section('content')
    <?php $perfil=""; ?>
    @include('modal-troca-senha')
    <div class="container-fluid">
        <div class="py-4">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @include('mensagens')
                    <div class="row">
                        <div class="col-md-6">
                            @include('_nav-dados-usuario')
                        </div>
                        <div class="col-md-6">
                            @include('_nav-perfis')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

