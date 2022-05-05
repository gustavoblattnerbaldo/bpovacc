@section('content')
	
	@include('assets.messages.alerts')
	
	<div class="col-md-12">
		<h1>
			<i class="fa fa-home"></i> {{ trans('translate.dashboard') }}
		</h1>
	</div>

	<div class="col-sm-6 col-md-6">
		<div class="widget widget-stats bg-blue">
			<div class="stats-icon stats-icon-lg"><i class="fa fa-users fa-fw"></i></div>
			<div class="stats-title">{{ trans('translate.tickets') }}</div>
			<div class="stats-number">{{ sizeof($tickets) }}</div>
			<hr>
			<div class="stats-desc">{{ trans('translate.number_of_staff') }}</div>
		</div> 	
	</div>  

	<div class="col-sm-6 col-md-6">
		<div class="widget widget-stats bg-purple">
			<div class="stats-icon stats-icon-lg"><i class="fa fa-comment fa-fw"></i></div>
			<div class="stats-title">{{ trans('translate.replies') }}</div>
			<div class="stats-number">{{ $totalReplies }}</div>
			<hr>
			<div class="stats-desc">{{ trans('translate.number_of_tickets') }}</div>
		</div> 
	</div> 		


	<div class="col-md-12">
		<h3>{{ trans('translate.last') }} 10 {{ trans('translate.tickets') }}</h3>

		<div id="ajaxTable" class="table-responsive">
			@include('users.tickets.table')	
		</div>	
	</div>	

@stop	 