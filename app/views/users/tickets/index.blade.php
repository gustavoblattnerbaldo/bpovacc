@section('content')

	@if ( $userIsClient )
		<div class="col-sm-6 col-md-6">
			<div class="widget widget-stats bg-blue">
				<div class="stats-icon stats-icon-lg"><i class="fa fa-comment fa-fw"></i></div>
				<div class="stats-title">{{ trans('translate.tickets') }}</div>
				<div class="stats-number">{{ sizeof($tickets) }}</div>
				<hr>
				<div class="stats-desc">{{ trans('translate.number_of_staff') }}</div>
			</div> 	
		</div>  

		<div class="col-sm-6 col-md-6">
			<div class="widget widget-stats bg-purple">
				<div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
				<div class="stats-title">{{ trans('translate.replies') }}</div>
				<div class="stats-number">{{ sizeof($replies) }}</div>
				<hr>
				<div class="stats-desc">{{ trans('translate.number_of_tickets') }}</div>
			</div> 
		</div>		
	@endif

	<div class="col-md-12 ">
		<h1>
			<i class="fa fa-list"></i> {{ trans('translate.tickets') }}
		</h1>
		
		@if ( $userIsClient )
			<button type="button" class="btn btn-primary solsoShowModal"
			data-toggle="modal" data-target="#solsoCrudModal" data-href="{{ URL::to('ticket/create') }}" data-modal-title="{{ trans('translate.create_new_ticket') }}">
				<i class="fa fa-plus"></i> {{ trans('translate.create_new_ticket') }}
			</button>
		@endif
	</div>	

	<div class="col-md-12 top40">
		<h3>{{ trans('translate.tickets') }}</h3>

		<div id="ajaxTable" class="table-responsive">
			@include('users.tickets.table')	
		</div>	
	</div>
	
@stop