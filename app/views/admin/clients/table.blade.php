<table class="table solsoTable table-striped" data-alert="{{ isset($alert) ? $alert : false }}" data-all="{{ sizeof($clients) }}">
	<thead>
		<tr>
			<th>{{ trans('translate.crt') }}</th>
			<th>{{ trans('translate.name') }}</th>
			<th>{{ trans('translate.email') }}</th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
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
			<td style="max-width: 30px">		
				<button type="button" class="btn btn-primary btn-geral solsoShowModal" 
				data-toggle="modal" data-target="#solsoCrudModal" data-href="{{ URL::to('client/' . $v->id . '/password') }}" data-modal-title="{{ trans('translate.edit_staff') }}">
					<i class="fa fa-key"></i>
				</button>
			</td>	
			<td style="max-width: 30px">
				@if ( $v->invitation == 1)
				<button type="button" class="btn solso-pdf btn-geral solsoAjax" disabled>
						<i class="fa fa-check"></i>
					</button>
				@else
					<input type="hidden" name="solsoStatus" value="{{ isset($alert) ? $alert : 'false'; }}">
					<button type="button" class="btn solso-pdf btn-geral solsoAjax"
						data-href="{{ URL::to('client/' . $v->id . '/send-invitation') }}" data-method="get"
						data-message-title="{{ trans('translate.update_notification') }}" data-message-error="{{ trans('translate.an_error_occurred') }}" 
						data-message-success="{{ trans('translate.email_was_sent_to_client') }}" data-message-warning="{{ trans('translate.an_error_occurred') }}">
						
						<i class="fa fa-paper-plane-o"></i>
					</button>
				@endif
			</td>
			
			<td style="max-width: 30px">
				@if ($v->status == 1)
					<button type="button" class="btn btn-warning btn-geral solsoConfirm" 
					data-toggle="modal" data-target="#solsoBanAccount" data-href="{{ URL::to('user/' . $v->id . '/ban') }}">
						<i class="fa fa-ban"></i>
					</button>
				@else
					<button type="button" class="btn btn-success btn-geral solsoConfirm" 
					data-toggle="modal" data-target="#solsoRemoveBan" data-href="{{ URL::to('user/' . $v->id . '/ban') }}">
						<i class="fa fa-check"></i>
					</button>					
				@endif
			</td>			
			
			<td style="max-width: 30px">		
				<button type="button" class="btn btn-primary btn-geral solsoShowModal" 
				data-toggle="modal" data-target="#solsoCrudModal" data-href="{{ URL::to('client/' . $v->id . '/edit') }}" data-modal-title="{{ trans('translate.edit_client') }}">
					<i class="fa fa-edit"></i>
			</td>			
			
			<td style="max-width: 45px">		
				<button type="button" class="btn btn-danger btn-geral solsoConfirm" 
				data-toggle="modal" data-target="#solsoDeleteModal" data-href="{{ URL::to('client/' . $v->id) }}">
					<i class="fa fa-trash"></i>
				</button>
			</td>
		</tr>
		
	@endforeach
	
	</tbody>
</table>
