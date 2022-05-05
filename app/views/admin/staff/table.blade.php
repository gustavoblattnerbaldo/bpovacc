<table class="table solsoTable" data-alert="{{ isset($alert) ? $alert : false }}" data-all="{{ sizeof($staff) }}">
	<thead>
		<tr>
			<th>{{ trans('translate.crt') }}</th>
			<th>{{ trans('translate.name') }}</th>
			<th>{{ trans('translate.email') }}</th>
			<th>{{ trans('translate.department') }}</th>
			<th class="small">{{ trans('translate.action') }}</th>
			<th class="small">{{ trans('translate.action') }}</th>
		</tr>
	</thead>
	
	<tbody>

	@foreach ($staff as $crt => $v)
	
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
				{{ trans('translate.' . Language::translateSlug($v->department, '_')) }}
			</td>							

			<td>		
				<button type="button" class="btn btn-primary solsoShowModal" 
				data-toggle="modal" data-target="#solsoCrudModal" data-href="{{ URL::to('staff/' . $v->userID . '/edit') }}" data-modal-title="{{ trans('translate.edit_staff') }}">
					<i class="fa fa-edit"></i> {{ trans('translate.edit') }}
				</button>
			</td>			
			
			<td>		
				<button type="button" class="btn btn-danger solsoConfirm" 
				data-toggle="modal" data-target="#solsoDeleteModal" data-href="{{ URL::to('staff/' . $v->userID) }}">
					<i class="fa fa-trash"></i> {{ trans('translate.delete') }}
				</button>
			</td>
		</tr>
		
	@endforeach
	
	</tbody>
</table>
