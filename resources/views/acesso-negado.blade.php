@extends('principal')
@section('content')
	@include('_navbar-principal')
    <?php $perfil=""?>
	<div class="container-fluid">
		<div class="py-4">
			<div class="row justify-content-center">
				<div class="col-md-8">
					<div class="card">
						<div class="card-header bg-danger text-white"><div class="text-md-center"><h1><span class="fa fa-user-lock"></span> Acesso Negado <span class="fa fa-user-lock"></span></h1></div></div>
						<div class="card-body">
							<p>Seu usuário não possue acesso a isso.</p>
							<p><a href="/home" class="btn btn-danger"><i class="far fa-thumbs-up"></i> Ok, entendi!</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection