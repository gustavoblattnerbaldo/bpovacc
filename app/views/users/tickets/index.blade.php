@section('content')

	@if ( $userIsClient )
		<div class="col-sm-6 col-md-3 top20">
			<div class="widget widget-stats bg-blue">
				<div class="stats-icon stats-icon-lg"><i class="fa fa-comment fa-fw"></i></div>
				<div class="stats-title">Tickets</div>
				<div class="stats-number">{{ sizeof($tickets) }}</div>
			</div> 	
		</div>  

		<div class="col-sm-6 col-md-3 top20">
			<div class="widget widget-stats bg-purple">
				<div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
				<div class="stats-title">Respostas</div>
				<div class="stats-number">{{ sizeof($replies) }}</div>
			</div> 
		</div>		
	@endif

	@if ( ! $userIsClient )
	<div class="col-md-12 bottom20">
		<h3>Tickets</h3>
	</div>
	@endif

	<div class="col-md-12 ">
		@if ( $userIsClient )
			<button type="button" class="btn btn-position-right-dash solsoShowModal"
			data-toggle="modal" data-target="#solsoCrudModal" data-href="{{ URL::to('ticket/create') }}" data-modal-title="{{ trans('translate.create_new_ticket') }}">
				<i class="fa fa-plus"></i> Novo Ticket
			</button>
		@endif
	</div>	

	<div class="col-md-12">
		<div id="ajaxTable" class="table-responsive">
			@include('users.tickets.table')	
		</div>	
	</div>
	
@stop