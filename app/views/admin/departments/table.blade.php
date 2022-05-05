<table class="table solsoTable" data-alert="{{ isset($alert) ? $alert : false }}" data-all="{{ sizeof($departments) }}">
	<thead>
		<tr>
			<th>{{ trans('translate.crt') }}</th>
			<th>{{ trans('translate.name') }}</th>
			<th class="small">{{ trans('translate.action') }}</th>
			<th class="small">{{ trans('translate.action') }}</th>
		</tr>
	</thead>
	
	<tbody>

	@foreach ($departments as $crt => $v)
	
		<tr>
			<td>
				{{ $crt+1 }}
			</td>
			
			<td>
				{{ trans('translate.' . Language::translateSlug($v->name, '_')) }}
			</td>				

			<td>		
				<button type="button" class="btn btn-primary solsoShowModal" 
				data-toggle="modal" data-target="#solsoCrudModal" data-href="{{ URL::to('department/' . $v->id . '/edit') }}" data-modal-title="{{ trans('translate.edit_department') }}">
					<i class="fa fa-edit"></i> {{ trans('translate.edit') }}
				</button>
			</td>			
			
			<td>		
				<button type="button" class="btn btn-danger solsoConfirm" 
				data-toggle="modal" data-target="#solsoDeleteModal" data-href="{{ URL::to('department/' . $v->id) }}">
					<i class="fa fa-trash"></i> {{ trans('translate.delete') }}
				</button>
			</td>
		</tr>
		
	@endforeach
	
	</tbody>
</table>
