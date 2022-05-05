<table class="table solsoTable" data-alert="{{ isset($alert) ? $alert : false }}" data-all="{{ sizeof($clients) }}">
	<thead>
		<tr>
			<th>{{ trans('translate.crt') }}</th>
			<th>{{ trans('translate.name') }}</th>
			<th>{{ trans('translate.email') }}</th>
			<th class="small">{{ trans('translate.action') }}</th>
			<th class="small">{{ trans('translate.action') }}</th>
			<th class="small">{{ trans('translate.action') }}</th>
			<th class="small">{{ trans('translate.action') }}</th>
		</tr>
	</thead>
	
	<tbody>

	@foreach ($clients as $crt => $v)
	
		<tr>
			<td>
				{{ $crt+1 }}
			</td>
			
			<td>
				{{ $v->name }}
			</td>				
			
			<td>
				{{ $v->email }}
			</td>	

			<td>
				@if ( $v->invitation == 1)
					{{ trans('translate.invitation_was_sent') }}
				@else
					<input type="hidden" name="solsoStatus" value="{{ isset($alert) ? $alert : 'false'; }}">
					<button type="button" class="btn solso-pdf solsoAjax"
						data-href="{{ URL::to('client/' . $v->id . '/send-invitation') }}" data-method="get"
						data-message-title="{{ trans('translate.update_notification') }}" data-message-error="{{ trans('translate.an_error_occurred') }}" 
						data-message-success="{{ trans('translate.email_was_sent_to_client') }}" data-message-warning="{{ trans('translate.an_error_occurred') }}">
						
						{{ trans('translate.send_invitation') }}
					</button>
				@endif
			</td>
			
			<td>
				@if ($v->status == 1)
					<button type="button" class="btn btn-warning solsoConfirm" 
					data-toggle="modal" data-target="#solsoBanAccount" data-href="{{ URL::to('user/' . $v->id . '/ban') }}">
						<i class="fa fa-ban"></i> {{ trans('translate.ban_account') }}
					</button>
				@else
					<button type="button" class="btn btn-success solsoConfirm" 
					data-toggle="modal" data-target="#solsoRemoveBan" data-href="{{ URL::to('user/' . $v->id . '/ban') }}">
						<i class="fa fa-check"></i> {{ trans('translate.remove_ban') }}
					</button>					
				@endif
			</td>			
			
			<td>		
				<button type="button" class="btn btn-primary solsoShowModal" 
				data-toggle="modal" data-target="#solsoCrudModal" data-href="{{ URL::to('client/' . $v->id . '/edit') }}" data-modal-title="{{ trans('translate.edit_client') }}">
					<i class="fa fa-edit"></i> {{ trans('translate.edit') }}
				</button>
			</td>			
			
			<td>		
				<button type="button" class="btn btn-danger solsoConfirm" 
				data-toggle="modal" data-target="#solsoDeleteModal" data-href="{{ URL::to('client/' . $v->id) }}">
					<i class="fa fa-trash"></i> {{ trans('translate.delete') }}
				</button>
			</td>
		</tr>
		
	@endforeach
	
	</tbody>
</table>
