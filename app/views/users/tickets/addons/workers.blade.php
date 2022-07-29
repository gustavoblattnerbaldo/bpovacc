<div class="modal-dialog modal-md">
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title"> {{ $ticket->title }} </h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
		</div>

<div class="modal-body">
			<div class="row">
@if ($workers)
	<div class="col-md-12">
		<table class="table table-striped" style="margin: 0" data-alert="{{ isset($alert) ? $alert : false }}">
		<caption>{{ trans('translate.staff_assigned_ticket') }}</caption>
		<tbody>
			@if ($ticket->staff_id != 0)
				<tr>
					<td>
						{{ $ticket->staff }}
					</td>
				</tr>	
			@endif	
		</tbody>
		</table>
		
		@if ($ticket->staff_id == 0)
			<div role="alert" class="alert alert-warning">
				<strong>{{ trans('translate.message') }}: </strong> {{ trans('translate.no_staff_assigned') }}
			</div>
		@endif	
	</div>
@endif

<div class="col-md-12">
	@if ($workers)
		<table class="table table-striped" style="margin-top: 10">
		<caption>{{ trans('translate.staff') }}</caption>
		<thead>
			<th>{{ trans('translate.crt') }}.</th>
			<th class="col-md-10">{{ trans('translate.staff') }}</th>
			<th class="col-md-2">{{ trans('translate.action') }}</th>
		</thead>
		
		<tbody>
			@foreach ($workers as $crt => $info)
				<tr>
					<td>
						{{ $crt+1 }}
					</td>		

					<td>
						{{ $info->name }}
					</td>
					
					<td class="text-right">
						{{ Form::open(array('url' => 'ticket/manage-worker/' . $info->staffID, 'role' => 'form', 'method' => 'POST', 'class' => 'solsoForm' )) }}
							<input type="hidden" name="ticketID" value="{{ $ticket->id }}">
							
							@if ( $ticket->staff_id == $info->staffID )
								{{ trans('translate.already_assigned') }}
							@else	
								<button type="button" class="btn btn-yellow solsoSave"
								data-message-title="{{ trans('translate.update_notification') }}" data-message-error="{{ trans('translate.validation_error_messages') }}" 
								data-message-success="{{ trans('translate.data_was_updated') }}" data-message-warning="{{ trans('translate.worker_is_already_assign') }}">
									@if ($ticket->staff_id == 0)
										<i class="fa fa-plus"></i> {{ trans('translate.assign') }}
									@else
										<i class="fa fa-share"></i> {{ trans('translate.replace') }}
									@endif
								</button>
							@endif
							
						{{ Form::close() }}	

					</td>
				</tr>	
			@endforeach
		</tbody>
		</table>
	@else
		<div role="alert" class="alert alert-warning">
			<strong>{{ trans('translate.message') }}: </strong> {{ trans('translate.no_staff_department') }}
		</div>
	@endif	
</div>	

	</div>
		</div>
	<div class="modal-footer">
			<button type="reset" class="btn btn-default" data-dismiss="modal">
				{{ trans('translate.cancel') }}
			</button>
		</div>
		</div>
</div>