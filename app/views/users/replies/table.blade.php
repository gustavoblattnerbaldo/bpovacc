<table class="table solsoTable table-striped" data-alert="{{ isset($alert) ? $alert : false }}" data-all="{{ sizeof($replies) }}">
	<thead>
		<tr>
			<th>{{ trans('translate.crt') }}.</th>
			
			@if ($user->role_id == 1)
				<th>Enviado por</th>
			@endif
			
			<th class="col-md-3">{{ trans('translate.title') }}</th>
			<th>{{ trans('translate.content') }}</th>
			<th class="small text-center">Criado em</th>
			<th class="small">{{ trans('translate.state') }}</th>
			
			<th style="max-width: 25px"></th>
			
			@if ( $userIsClient )
				<th style="max-width: 35px"></th>
			@endif
		</tr>
	</thead>
	
	<tbody>
	
	@foreach ($replies as $crt => $v)
		<tr>
			<td>
				{{ $crt+1 }}
			</td>
			
			@if ($user->role_id == 1)
				<td>
					@if ($v->role_id == 3)
						<label class="label-client">{{ trans('translate.client') }}: {{ $v->name }}</label>
					@else
						<label class="label-owner">{{ trans('translate.staff') }}: {{ $v->name }}</label>
					@endif	
					
				</td>
			@endif
			
			<td>
				{{ $v->title }}
			</td>		

			<td>
				{{ strip_tags(substr($v->content, 0, 100)) }}
			</td>
			
			<td class="text-center">
				{{ $v->created_at }}
			</td>				

			<td>
				@if ($v->state == 0)
					<label class="label-red">{{ trans('translate.unread') }}</label>
				@else
					<label class="label-green">{{ trans('translate.read') }}</label>
				@endif
			</td>			
			
			<td>
				<button type="button" class="btn btn-info btn-geral solsoShowModal" 
				data-toggle="modal" data-target="#solsoCrudModal" data-href="{{ URL::to('reply/' . $v->id) }}" data-modal-title="{{ trans('translate.show_reply') }}">
					<i class="fa fa-eye"></i>
				</button>
			</td>	
			
			@if ( $userIsClient )
				<td>		
					<button type="button" class="btn btn-danger btn-geral solsoConfirm" 
					data-toggle="modal" data-target="#solsoDeleteModal" data-href="{{ URL::to('reply/' . $v->id) }}">
						<i class="fa fa-trash"></i>
					</button>
				</td>		
			@endif
		</tr>
	@endforeach
	
	</tbody>
</table>