@section('content')
	<div class="col-sm-6 col-md-3 top6p">
		<div class="widget widget-stats bg-yellow">
			<div class="stats-icon stats-icon-lg"><i class="fa fa-list fa-fw"></i></div>
			<div class="stats-title">{{ trans('translate.departments') }}</div>
			<div class="stats-number">{{ $totalDepartments }}</div>
		</div> 	
	</div> 	

	<div class="col-sm-6 col-md-3 top6p">
		<div class="widget widget-stats bg-yellow">
			<div class="stats-icon stats-icon-lg"><i class="fa fa-users fa-fw"></i></div>
			<div class="stats-title">{{ trans('translate.staff') }}</div>
			<div class="stats-number">{{ $totalStaff }}</div>
		</div> 	
	</div>  

	<div class="col-sm-6 col-md-3 top6p">
		<div class="widget widget-stats bg-yellow">
			<div class="stats-icon stats-icon-lg"><i class="fa fa-users fa-fw"></i></div>
			<div class="stats-title">{{ trans('translate.clients') }}</div>
			<div class="stats-number">{{ $totalClients }}</div>
		</div> 
	</div> 		

	<div class="col-sm-6 col-md-3 top6p">
		<div class="widget widget-stats bg-yellow">
			<div class="stats-icon stats-icon-lg"><i class="fa fa-comment fa-fw"></i></div>
			<div class="stats-title">{{ trans('translate.tickets') }}</div>
			<div class="stats-number">{{ $totalTickets }}</div>
		</div> 
	</div>	
	
	<div class="col-md-12">
		<div id="ajaxTable" class="table-responsive">
		@include('users.tickets.table')	
		</div>	
	</div>	
@stop	