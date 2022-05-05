<div class="col-md-12 col-lg-8">
	<h3>{{ trans('translate.ticket_priority') }}</h3>
	<div class="row">
		<div class="col-md-6">
		{{ Form::open(array('role' => 'form')) }}

			<label for="value">{{ trans('translate.new_value') }}</label>
			<div class="input-group">
				<input type="text" name="value" class="form-control required" autocomplete="off" value="{{ Input::old('value') }}" data-parsley-errors-container=".createPriority">

				<span class="input-group-btn">
					<input type="hidden" name="solsoStatus" value="{{ isset($alert) ? $alert : 'false'; }}">
					<button type="submit" class="btn btn-success solsoAjax" 
						data-href="{{ URL::to('ticketPriority') }}" data-method="post" data-return="tabTickets" 
						data-message-title="{{ trans('translate.create_notification') }}" data-message-error="{{ trans('translate.validation_error_messages') }}" 
						data-message-success="{{ trans('translate.data_was_saved') }}" data-message-warning="{{ trans('translate.value_already_exist') }}">
						<i class="fa fa-save"></i> {{ trans('translate.save') }}
					</button>
				</span>	
			</div>
			
			<div class="createPriority"></div>
			<?php echo $errors->first('value', '<p class="error">:messages</p>');?>
			
		{{ Form::close() }}
		</div>
	</div>
	<div class="clearfix"></div>		

	<div class="table-responsive">
		<table class="table top20" data-alert="{{ isset($alert) ? $alert : false }}">
			<thead>
				<tr>
					<th>{{ trans('translate.crt') }}.</th>
					<th>{{ trans('translate.name') }}</th>
					<th class="col-md-4 col-4">{{ trans('translate.action') }}</th>
					<th class="small">{{ trans('translate.action') }}</th>
				</tr>
			</thead>
			
			@if ( sizeof($ticketPriorities) != 0 )
				<tbody>
					@foreach ($ticketPriorities as $crt => $v)
				
					<tr>
						<td> 
							{{ $crt + 1 }} 
						</td>
						
						<td> 
							{{ trans('translate.' . Language::translateSlug($v->name, '_')) }}
						</td>
						
						<td>
							<form>
								<div class="input-group">
									<input type="text" name="priority" class="form-control required" value="{{ trans('translate.' . Language::translateSlug($v->name, '_')) }}"
									autocomplete="off" data-parsley-errors-container=".priorityError{{ $crt }}">
									
									<span class="input-group-btn">
										<input type="hidden" name="oldValue" value="{{ $v->name }}">
										<button type="submit" class="btn btn-success solsoAjax" 
											data-href="{{ URL::to('ticketPriority/' . $v->id) }}" data-method="put" data-return="tabTickets" 
											data-message-title="{{ trans('translate.create_notification') }}" data-message-error="{{ trans('translate.validation_error_messages') }}" 
											data-message-success="{{ trans('translate.data_was_saved') }}" data-message-warning="{{ trans('translate.value_already_exist') }}">
											<i class="fa fa-save"></i> {{ trans('translate.update') }}
										</button>
									</span>	
								</div>
								
								<div class="priorityError{{ $crt }}"></div>
							</form>
						</td>
						
						<td>
							<a class="btn btn-danger solsoConfirm" data-toggle="modal" data-target="#solsoDeleteModal" 
							data-href="{{ URL::to('ticketPriority/' . $v->id) }}" data-return="tabTickets">
								<i class="fa fa-trash"></i> {{ trans('translate.delete') }}
							</a>
						</td>
					</tr>
					
					@endforeach
					
				</tbody>
			@else
				<tfoot>
					<tr>
						<td colspan="4">
							{{ trans('translate.no_data_available') }}
						</td>
					</tr>
				</tfoot>
			@endif	
		</table>
	</div>
</div>


<div class="col-md-12 col-lg-8">
	<h3>{{ trans('translate.ticket_type') }}</h3>
	<div class="row">
		<div class="col-md-6">
		{{ Form::open(array('role' => 'form')) }}

			<label for="value">{{ trans('translate.new_value') }}</label>
			<div class="input-group">
				<input type="text" name="value" class="form-control required" autocomplete="off" value="{{ Input::old('value') }}" data-parsley-errors-container=".createType">

				<span class="input-group-btn">
					<input type="hidden" name="solsoStatus" value="{{ isset($alert) ? $alert : 'false'; }}">
					<button type="submit" class="btn btn-success solsoAjax" 
						data-href="{{ URL::to('ticketType') }}" data-method="post" data-return="tabTickets" 
						data-message-title="{{ trans('translate.create_notification') }}" data-message-error="{{ trans('translate.validation_error_messages') }}" 
						data-message-success="{{ trans('translate.data_was_saved') }}" data-message-warning="{{ trans('translate.value_already_exist') }}">
						<i class="fa fa-save"></i> {{ trans('translate.save') }}
					</button>
				</span>	
			</div>
			
			<div class="createType"></div>
			<?php echo $errors->first('value', '<p class="error">:messages</p>');?>
			
		{{ Form::close() }}
		</div>
	</div>
	<div class="clearfix"></div>		

	<div class="table-responsive">
		<table class="table top20" data-alert="{{ isset($alert) ? $alert : false }}">
			<thead>
				<tr>
					<th>{{ trans('translate.crt') }}.</th>
					<th>{{ trans('translate.name') }}</th>
					<th class="col-md-4 col-4">{{ trans('translate.action') }}</th>
					<th class="small">{{ trans('translate.action') }}</th>
				</tr>
			</thead>
			
			@if ( sizeof($ticketTypes) != 0 )
				<tbody>
					@foreach ($ticketTypes as $crt => $v)
				
					<tr>
						<td> 
							{{ $crt + 1 }} 
						</td>
						
						<td> 
							{{ trans('translate.' . Language::translateSlug($v->name, '_')) }}
						</td>
						
						<td>
							<form>
								<div class="input-group">
									<input type="text" name="type" class="form-control required" value="{{ trans('translate.' . Language::translateSlug($v->name, '_')) }}"
									autocomplete="off" data-parsley-errors-container=".typeError{{ $crt }}">
									
									<span class="input-group-btn">
										<input type="hidden" name="oldValue" value="{{ $v->name }}">
										<button type="submit" class="btn btn-success solsoAjax" 
											data-href="{{ URL::to('ticketType/' . $v->id) }}" data-method="put" data-return="tabTickets" 
											data-message-title="{{ trans('translate.create_notification') }}" data-message-error="{{ trans('translate.validation_error_messages') }}" 
											data-message-success="{{ trans('translate.data_was_saved') }}" data-message-warning="{{ trans('translate.value_already_exist') }}">
											<i class="fa fa-save"></i> {{ trans('translate.update') }}
										</button>
									</span>	
								</div>
								
								<div class="typeError{{ $crt }}"></div>
							</form>
						</td>
						
						<td>
							<a class="btn btn-danger solsoConfirm" data-toggle="modal" data-target="#solsoDeleteModal" 
							data-href="{{ URL::to('ticketType/' . $v->id) }}" data-return="tabTickets">
								<i class="fa fa-trash"></i> {{ trans('translate.delete') }}
							</a>
						</td>
					</tr>
					
					@endforeach
					
				</tbody>
			@else
				<tfoot>
					<tr>
						<td colspan="4">
							{{ trans('translate.no_data_available') }}
						</td>
					</tr>
				</tfoot>
			@endif	
		</table>
	</div>
</div>

<div class="col-md-12 col-lg-8">
	<h3>{{ trans('translate.ticket_status') }}</h3>

	<div class="row">
		<div class="col-md-6">
		{{ Form::open(array('role' => 'form')) }}

			<label for="value">{{ trans('translate.new_value') }}</label>
			<div class="input-group">
				<input type="text" name="value" class="form-control required" autocomplete="off" value="{{ Input::old('value') }}" data-parsley-errors-container=".createStatus">

				<span class="input-group-btn">
					<input type="hidden" name="solsoStatus" value="{{ isset($alert) ? $alert : 'false'; }}">
					<button type="submit" class="btn btn-success solsoAjax" 
						data-href="{{ URL::to('ticketStatus') }}" data-method="post" data-return="tabTickets" 
						data-message-title="{{ trans('translate.create_notification') }}" data-message-error="{{ trans('translate.validation_error_messages') }}" 
						data-message-success="{{ trans('translate.data_was_saved') }}" data-message-warning="{{ trans('translate.value_already_exist') }}">
						<i class="fa fa-save"></i> {{ trans('translate.save') }}
					</button>
				</span>	
			</div>
			
			<div class="createStatus"></div>
			<?php echo $errors->first('value', '<p class="error">:messages</p>');?>
			
		{{ Form::close() }}
		</div>
	</div>
	<div class="clearfix"></div>		

	<div class="table-responsive">
		<table class="table top20" data-alert="{{ isset($alert) ? $alert : false }}">
			<thead>
				<tr>
					<th>{{ trans('translate.crt') }}.</th>
					<th>{{ trans('translate.name') }}</th>
					<th class="col-md-4 col-4">{{ trans('translate.action') }}</th>
					<th class="small">{{ trans('translate.action') }}</th>
				</tr>
			</thead>
			
			@if ( sizeof($ticketStatuses) != 0 )
				<tbody>
					@foreach ($ticketStatuses as $crt => $v)
				
					<tr>
						<td> 
							{{ $crt + 1 }} 
						</td>
						
						<td> 
							{{ trans('translate.' . Language::translateSlug($v->name, '_')) }}
						</td>
						
						<td>
							<form>
								<div class="input-group">
									<input type="text" name="status" class="form-control required" value="{{ trans('translate.' . Language::translateSlug($v->name, '_')) }}"
									autocomplete="off" data-parsley-errors-container=".statusError{{ $crt }}">
									
									<span class="input-group-btn">
										<input type="hidden" name="oldValue" value="{{ $v->name }}">
										<button type="submit" class="btn btn-success solsoAjax" 
											data-href="{{ URL::to('ticketStatus/' . $v->id) }}" data-method="put" data-return="tabTickets" 
											data-message-title="{{ trans('translate.create_notification') }}" data-message-error="{{ trans('translate.validation_error_messages') }}" 
											data-message-success="{{ trans('translate.data_was_saved') }}" data-message-warning="{{ trans('translate.value_already_exist') }}">
											<i class="fa fa-save"></i> {{ trans('translate.update') }}
										</button>
									</span>	
								</div>
								
								<div class="statusError{{ $crt }}"></div>
							</form>
						</td>
						
						<td>
							<a class="btn btn-danger solsoConfirm" data-toggle="modal" data-target="#solsoDeleteModal" 
							data-href="{{ URL::to('ticketStatus/' . $v->id) }}" data-return="tabTickets">
								<i class="fa fa-trash"></i> {{ trans('translate.delete') }}
							</a>
						</td>
					</tr>
					
					@endforeach
					
				</tbody>
			@else
				<tfoot>
					<tr>
						<td colspan="4">
							{{ trans('translate.no_data_available') }}
						</td>
					</tr>
				</tfoot>
			@endif	
		</table>
	</div>
</div>