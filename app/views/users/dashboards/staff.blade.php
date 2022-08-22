@section('content')
	
	@include('assets.messages.alerts')

	<div class="col-sm-6 col-md-3 top6p">
		<div class="widget widget-stats bg-yellow">
			<div class="stats-icon stats-icon-lg"><i class="fa fa-users fa-fw"></i></div>
			<div class="stats-title">{{ trans('translate.tickets') }}</div>
			<div class="stats-number">{{ sizeof($tickets) }}</div>
		</div> 	
	</div>  

	<div class="col-sm-6 col-md-3 top6p">
		<div class="widget widget-stats bg-yellow">
			<div class="stats-icon stats-icon-lg"><i class="fa fa-comment fa-fw"></i></div>
			<div class="stats-title">Acompanhamento</div>
			<div class="stats-number">{{ $totalReplies }}</div>
		</div> 
	</div> 		


	<div class="col-md-12">
		<div id="ajaxTable" class="table-responsive">
			@include('users.tickets.table')	
		</div>	
	</div>	

@stop	 