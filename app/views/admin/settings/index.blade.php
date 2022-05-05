@section('content')

	<div class="col-md-12">
		<h1><i class="fa fa-cogs"></i> {{ trans('translate.settings') }}</h1>
	</div>		
	
	<div class="col-md-12">
		<ul id="solsoTabs" class="nav nav-tabs" role="tablist">
			<li class="active"><a href="#tabCompany" role="tab" data-toggle="tab">{{ trans('translate.company') }}</a></li>
			<li><a href="#tabInvitation" role="tab" data-toggle="tab">{{ trans('translate.invitation') }}</a></li>
			<li><a href="#tabTickets" role="tab" data-toggle="tab">{{ trans('translate.tickets') }}</a></li>
			<li><a href="#tabLanguage" role="tab" data-toggle="tab">{{ trans('translate.languages') }}</a></li>
			<li><a href="#tabAccount" role="tab" data-toggle="tab">{{ trans('translate.account') }}</a></li>
			<li><a href="#tabPassword" role="tab" data-toggle="tab">{{ trans('translate.password') }}</a></li>
			<li><a href="#tabEmail" role="tab" data-toggle="tab">{{ trans('translate.email') }}</a></li>
		</ul>
		
		<div class="row tab-content">
			<div class="tab-pane active" id="tabCompany">
				@include('admin.settings.company')
			</div>		
		
			<div class="tab-pane" id="tabInvitation">
				@include('admin.settings.invitation')
			</div>

			<div class="tab-pane" id="tabTickets">
				@include('admin.settings.tickets')
			</div>			
			
			<div class="tab-pane" id="tabLanguage">
				@include('admin.settings.language')
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