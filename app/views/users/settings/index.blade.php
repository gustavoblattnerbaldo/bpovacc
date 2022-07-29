@section('content')

	<div class="col-md-12">
		<h3>Configurações</h3>
	</div>
	
	<div class="col-md-12 top20">
		<ul id="solsoTabs" class="nav nav-tabs" role="tablist">
			<li class="active"><a href="#tabDetails" role="tab" data-toggle="tab">{{ trans('translate.details') }}</a></li>
			<li><a href="#tabAccount" role="tab" data-toggle="tab">Alterar E-mail</a></li>
			<li><a href="#tabPassword" role="tab" data-toggle="tab">Alterar Senha</a></li>
		</ul>
		
		<div class="row tab-content">
			<div class="tab-pane active" id="tabDetails">
				@include('users.settings.details')
			</div>			

			<div class="tab-pane" id="tabAccount">
				@include('users.settings.account')
			</div>	

			<div class="tab-pane" id="tabPassword">
				@include('users.settings.password')
			</div>			
		</div>		
	</div>

	@include('assets.modals.modal-delete')
		
@stop