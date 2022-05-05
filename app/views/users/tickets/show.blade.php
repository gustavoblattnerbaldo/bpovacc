<div class="col-md-12">
	<div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true">
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="heading1">
				<h4 class="panel-title">
					{{ trans('translate.details') }}
					<a data-toggle="collapse" data-parent="#accordion1" href="#collapse1" aria-expanded="true" aria-controls="collapse1" class="pull-right">
						<i class="solsoCollapseIcon fa fa-chevron-up"></i>	
					</a>
				</h4>
			</div>
					
			<div id="collapse1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
				<div class="panel-body">
					<table class="table table-striped newTickets" data-alert="{{ isset($alert) ? $alert : false }}" data-all="{{ isset($newTickets) ? $newTickets : false }}">
						<tbody>
							@if ( $user->role_id == 1)
								<tr>
									<td>{{ trans('translate.assign_to') }}</td>
									<td>
										@if ($ticket->staff_id == 0)
											<label class="label-green">{{ trans('translate.free') }}</label>
										@elseif ($ticket->staff_id == 1)
											<label class="label-grey">{{ $ticket->staff }}</label>
										@else	
											<label class="label-owner">{{ $ticket->staff }}</label>
										@endif	
									</td>
								</tr>
							@endif

							<tr>
								<td>{{ trans('translate.client') }}</td>
								<td>
									<label class="label-client">{{ $ticket->client }}</label>
								</td>
							</tr>				
							
							<tr>
								<td>{{ trans('translate.department') }}</td>
								<td>{{ trans('translate.' . Language::translateSlug($ticket->department, '_')) }}</td>
							</tr>

							<tr>
								<td>{{ trans('translate.type') }}</td>
								<td>{{ trans('translate.' . Language::translateSlug($ticket->type, '_')) }}</td>
							</tr>	

							<tr>
								<td>{{ trans('translate.priority') }}</td>
								<td>{{ trans('translate.' . Language::translateSlug($ticket->priority, '_')) }}</td>
							</tr>

							<tr>
								<td>{{ trans('translate.status') }}</td>
								<td>
									@if ($ticket->status_id == 0)
										{{ trans('translate.processing') }}
									@else
										{{ trans('translate.' . Language::translateSlug($ticket->status, '_')) }}
									@endif								
								</td>
							
							
							<tr>
								<td>{{ trans('translate.content') }}</td>
								<td>{{ $ticket->content }}</td>
							</tr>
							</tr>
						<tbody>
					</table>
				</div>
			</div>					
		</div>					
	</div>					
	
	@if ($ticket->state == 0 && $user->role_id != 3)
		{{ Form::open(array('url' => 'ticket/' . $ticket->id .'/mark-as-read', 'role' => 'form', 'method' => 'POST')) }}
			<button type="button" class="btn btn-success solsoSave"
			data-message-title="{{ trans('translate.update_notification') }}" data-message-error="{{ trans('translate.validation_error_messages') }}" data-message-success="{{ trans('translate.ticket_was_mark_as_read') }}">
				<i class="fa fa-check"></i> {{ trans('translate.mark_as_read') }}
			</button>
		{{ Form::close() }}		
	@endif					
	
	
	@if ($ticket->number == 0 && $user->role_id != 3)
		<div role="alert" class="alert alert-info top40">
			<strong>{{ trans('translate.message') }}: </strong> {{ trans('translate.reply_notification') }}
		</div>			
	
		<h3>{{ trans('translate.reply_to') }} </h3>	

		{{ Form::open(array('url' => 'ticket/' . $ticket->id . '/reply', 'role' => 'form', 'method' => 'POST', 'class' => 'solsoForm')) }}
		
			<div class="form-group">
				<label for="title"> {{ trans('translate.title') }} </label>
				<input type="text" name="title" class="form-control required" autocomplete="off" value="{{ trans('translate.reply_to') }}: {{ $ticket->title }}">

				<?php echo $errors->first('title', '<p class="error">:messages</p>');?>
			</div>		
			
			<div class="form-group">
				<label for="content"> {{ trans('translate.message') }} </label>
				<textarea name="content" class="form-control required solsoEditor" rows="7" autocomplete="off"></textarea>
				
				<?php echo $errors->first('content', '<p class="error">:messages</p>');?>
			</div>	
			
			<div class="form-group">
				<input type="hidden" name="userID" value="{{ $ticket->client_id }}">
				<button type="button" class="btn btn-success solsoSave" 
				data-message-title="{{ trans('translate.update_notification') }}" data-message-error="{{ trans('translate.validation_error_messages') }}" data-message-success="{{ trans('translate.message_was_sent') }}">
					<i class="fa fa-share"></i> {{ trans('translate.send') }}
				</button>
			</div>
			
		{{ Form::close() }}		
	@else
		<div class="panel-group top40" id="accordion2" role="tablist" aria-multiselectable="true">
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="heading2">
					<h4 class="panel-title">
						{{ trans('translate.histories') }}
						<a data-toggle="collapse" data-parent="#accordion2" href="#collapse2" aria-expanded="true" aria-controls="collapse2" class="pull-right">
							<i class="solsoCollapseIcon fa fa-chevron-up"></i>	
						</a>
					</h4>
				</div>
						
				<div id="collapse2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading2">
					<div class="panel-body">						
					<table class="table table-striped">
						<tbody>				
							<tr>
								<td>
									<span class="label label-client">{{ $ticket->client }}</span>
									<span class="label-grey pull-right">{{ $ticket->created_at }}</span>
								
									<h4>{{ $ticket->title }}</h4>
									
									{{ $ticket->content }}
								</td>
							</tr>		
							
							@foreach ($histories as $id => $history)
								<tr>
									<td>
										@if ($history->role_id == 3)
											<span class="label label-client">{{ $history->client }}</span>
										@else
											<span class="label label-owner">{{ $owner }}</span>
										@endif
										<span class="label-grey pull-right">{{ $ticket->created_at }}</span>
										
										<h4>{{ $history->title }}</h4>
										
										{{ $history->content }}
									</td>
								</tr>					
							@endforeach
						</tbody>
					</table>	
					</div>
				</div>					
			</div>					
		</div>		
	@endif	
		
</div>