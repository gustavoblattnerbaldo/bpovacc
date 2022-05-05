@section('content')

	<div class="col-md-12">
		<h1>
			<i class="fa fa-home"></i> {{ trans('translate.dashboard') }}
		</h1>
		
		@if ($totalDepartments == 0)
			<div role="alert" class="alert alert-warning top20">
				<strong>{{ trans('translate.message') }}: </strong> {{ trans('translate.no_departments') }}
				{{ trans('translate.go_to') }} <a href="{{ URL::to('department') }}">{{ trans('translate.departments') }}</a>
			</div>
		@endif			

		@if (!$receive_emails)
			<div role="alert" class="alert alert-warning top20">
				<strong>{{ trans('translate.message') }}: </strong> {{ trans('translate.no_receive_emails') }}
				{{ trans('translate.go_to') }} <a href="{{ URL::to('admin/settings') }}">{{ trans('translate.settings') }}</a>
			</div>
		@endif
		
		@if (!$owner)
			<div role="alert" class="alert alert-warning top20">
				<strong>{{ trans('translate.message') }}: </strong> {{ trans('translate.no_details') }}
				{{ trans('translate.go_to') }} <a href="{{ URL::to('admin/settings') }}">{{ trans('translate.settings') }}</a>
			</div>
		@endif
				
		@if (!$invitation)
			<div role="alert" class="alert alert-warning top20">
				<strong>{{ trans('translate.message') }}: </strong> {{ trans('translate.no_invitation') }}
				{{ trans('translate.go_to') }} <a href="{{ URL::to('admin/settings') }}">{{ trans('translate.settings') }}</a>
			</div>
		@endif		
		
		@if ($ticketPriority == 0)
			<div role="alert" class="alert alert-warning top20">
				<strong>{{ trans('translate.message') }}: </strong> {{ trans('translate.no_ticket_priority') }}
				{{ trans('translate.go_to') }} <a href="{{ URL::to('admin/settings') }}">{{ trans('translate.settings') }}</a>
			</div>
		@endif			
		
		@if ($ticketType == 0)
			<div role="alert" class="alert alert-warning top20">
				<strong>{{ trans('translate.message') }}: </strong> {{ trans('translate.no_ticket_type') }}
				{{ trans('translate.go_to') }} <a href="{{ URL::to('admin/settings') }}">{{ trans('translate.settings') }}</a>
			</div>
		@endif		
		
		@if ($ticketStatus == 0)
			<div role="alert" class="alert alert-warning top20">
				<strong>{{ trans('translate.message') }}: </strong> {{ trans('translate.no_ticket_status') }}
				{{ trans('translate.go_to') }} <a href="{{ URL::to('admin/settings') }}">{{ trans('translate.settings') }}</a>
			</div>
		@endif	
	</div>
	
	<div class="col-sm-6 col-md-3">
		<div class="widget widget-stats bg-green">
			<div class="stats-icon stats-icon-lg"><i class="fa fa-list fa-fw"></i></div>
			<div class="stats-title">{{ trans('translate.departments') }}</div>
			<div class="stats-number">{{ $totalDepartments }}</div>
			<hr>
			<div class="stats-desc">{{ trans('translate.number_of_departments') }}</div>
		</div> 	
	</div> 	

	<div class="col-sm-6 col-md-3">
		<div class="widget widget-stats bg-blue">
			<div class="stats-icon stats-icon-lg"><i class="fa fa-users fa-fw"></i></div>
			<div class="stats-title">{{ trans('translate.staff') }}</div>
			<div class="stats-number">{{ $totalStaff }}</div>
			<hr>
			<div class="stats-desc">{{ trans('translate.number_of_staff') }}</div>
		</div> 	
	</div>  

	<div class="col-sm-6 col-md-3">
		<div class="widget widget-stats bg-purple">
			<div class="stats-icon stats-icon-lg"><i class="fa fa-users fa-fw"></i></div>
			<div class="stats-title">{{ trans('translate.clients') }}</div>
			<div class="stats-number">{{ $totalClients }}</div>
			<hr>
			<div class="stats-desc">{{ trans('translate.number_of_clients') }}</div>
		</div> 
	</div> 		

	<div class="col-sm-6 col-md-3">
		<div class="widget widget-stats bg-grey">
			<div class="stats-icon stats-icon-lg"><i class="fa fa-comment fa-fw"></i></div>
			<div class="stats-title">{{ trans('translate.tickets') }}</div>
			<div class="stats-number">{{ $totalTickets }}</div>
			<hr>
			<div class="stats-desc">{{ trans('translate.number_of_tickets') }}</div>
		</div> 
	</div>	
	
	<div class="col-md-12">
		<h3>{{ trans('translate.tickets') }}</h3>

		<div id="ajaxTable" class="table-responsive">
			@include('users.tickets.table')	
		</div>	
	</div>
	
	
	<div class="col-xs-12 col-sm-12 col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title">
					<i class="fa fa-bar-chart"></i> {{ trans('translate.clients') }} -> {{ trans('translate.this_month') }}
				</h2>
			</div>
			
			<div class="panel-body">
				<canvas id="reportClients" height="120" class="col-md-12"></canvas>
			</div>
		</div>	
	</div>	

	<div class="col-xs-12 col-sm-12 col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title">
					<i class="fa fa-bar-chart"></i> {{ trans('translate.tickets') }} -> {{ trans('translate.this_month') }}
				</h2>
			</div>
			
			<div class="panel-body">
				<canvas id="reportTickets" height="120" class="col-md-12"></canvas>
			</div>
		</div>	
	</div>	
	
@stop	