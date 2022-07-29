@section('content')
	<div class="col-md-12">
		<h3>{{ trans('translate.settings') }}</h3>
	</div>		
	
	<div class="col-md-12 top20">
		<ul id="solsoTabs" class="nav nav-tabs" role="tablist">
			<li class="active"><a href="#tabCompany" role="tab" data-toggle="tab">Empresa</a></li>
			<li><a href="#tabTickets" role="tab" data-toggle="tab">Tickets</a></li>
			<li><a href="#tabAccount" role="tab" data-toggle="tab">Alterar E-mail</a></li>
			<li><a href="#tabPassword" role="tab" data-toggle="tab">Alterar Senha</a></li>
			<li><a href="#tabEmail" role="tab" data-toggle="tab">Email de envio</a></li>
		</ul>
		
		<div class="row tab-content">
			<div class="tab-pane active" id="tabCompany">
				@include('admin.settings.company')
			</div>		

			<div class="tab-pane" id="tabTickets">
				@include('admin.settings.tickets')
			</div>			

			<div class="tab-pane" id="tabAccount">
				@include('admin.settings.account')
			</div>	

			<div class="tab-pane" id="tabPassword">
				@include('admin.settings.password')
			</div>			
			
			<div class="tab-pane" id="tabEmail">
				@include('admin.settings.email')
			</div>	
		</div>		
	</div>
		
@stop