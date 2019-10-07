@extends('layouts.app')

@section('content')
    <script>
        $(document).ready(function () {
            $('#link-endereco').click(function (event) {
                event.preventDefault();
                $(this).addClass("active");
                $('#link-credenciais').removeClass("active");
                $('#body-credenciais').slideUp(100);
                $('#body-endereco').slideDown();
            });
            $('#link-credenciais').click(function (event) {
                event.preventDefault();
                $(this).addClass("active");
                $('#link-endereco').removeClass("active");
                $('#body-endereco').slideUp(100);
                $('#body-credenciais').slideDown();
            });
            $("input[name='rg']").on("focusout",function () {
                $('#link-endereco').addClass("active");
                $('#link-credenciais').removeClass("active");
                $('#body-credenciais').slideUp(100);
                $('#body-endereco').slideDown();

            })
        });
    </script>

    <div class="container-fluid">
        <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
            @csrf
            <div class="row justify-content-center mb-3">
                <div class="col-md-8">
                    @include("erros")
                    <div class="card">
                        <div class="card-header"><i class="fa fa-user"></i> Dados Pessoais</div>

                        <div class="card-body">
                            @include("dados-pessoais-form")
                        </div>

                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a class="nav-link" id="link-endereco" href="#"><i class="fa fa-map-marker-alt"></i> Endereço</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="link-credenciais" href="#"><i class="fas fa-user-lock"></i> Credenciais</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body" id="body-endereco">
                            @include("_endereco-form")
                        </div>
                        <div class="card-body" id="body-credenciais">
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-mail') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar senha:') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Registrar') }}
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
