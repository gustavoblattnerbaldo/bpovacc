<table class="table table-striped solsoTable" data-alert="{{ isset($alert) ? $alert : false }}" data-all="{{ sizeof($departments) }}">
	<thead>
		<tr>
			<th>{{ trans('translate.crt') }}</th>
			<th>{{ trans('translate.name') }}</th>
			<th style="max-width: 40px"></th>
			<th style="max-width: 55px"></th>
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

			<td style="max-width: 40px">		
				<button type="button" class="btn btn-primary btn-geral solsoShowModal" 
				data-toggle="modal" data-target="#solsoCrudModal" data-href="{{ URL::to('department/' . $v->id . '/edit') }}" data-modal-title="{{ trans('translate.edit_department') }}">
					<i class="fa fa-edit"></i>
				</button>
			</td>			
			
			<td style="max-width: 55px">		
				<button type="button" class="btn btn-geral btn-danger solsoConfirm" 
				data-toggle="modal" data-target="#solsoDeleteModal" data-href="{{ URL::to('department/' . $v->id) }}">
					<i class="fa fa-trash"></i>
				</button>
			</td>
		</tr>
		
	@endforeach
	
	</tbody>
</table>
