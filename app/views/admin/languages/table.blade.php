<table class="table solsoTable" data-alert="{{ isset($alert) ? $alert : false }}">
	<thead>
		<tr>
			<th>{{ trans('translate.crt') }}.</th>
			<th>{{ trans('translate.language') }}</th>
			<th>{{ trans('translate.short_name') }}</th>
			<th class="small">{{ trans('translate.action') }}</th>
			<th class="small">{{ trans('translate.action') }}</th>
			<th class="small">{{ trans('translate.action') }}</th>
		</tr>
	</thead>
	
	<tbody>
		@foreach ($languages as $crt => $v)
			<tr>
				<td>
					{{ $crt+1 }}
				</td>

				<td>
					{{ $v->name }}
				</td>

				<td>
					{{ $v->short }}
				</td>

				<td>		
					<a class="btn solso-email" href="{{ URL::to('language/' . $v->id) }}">
						<i class="fa fa-book"></i> {{ trans('translate.translate') }}
					</a>
				</td>							
				
				<td>		
					<button type="button" class="btn btn-primary solsoShowModal" 
					data-toggle="modal" data-target="#solsoCrudModal" data-href="{{ URL::to('language/' . $v->id . '/edit') }}" data-modal-title="{{ trans('translate.edit_language') }}">
						<i class="fa fa-edit"></i> {{ trans('translate.edit') }}
					</button>
				</td>						

				<td>
					@if ($v->short == 'en')
						<button class="btn btn-danger" disabled>
							<i class="fa fa-trash"></i> {{ trans('translate.delete') }}
						</button>
					@else
						<button class="btn btn-danger solsoConfirm" 
						data-toggle="modal" data-target="#solsoDeleteModal" data-href="{{ URL::to('language/' . $v->id) }}">
							<i class="fa fa-trash"></i> {{ trans('translate.delete') }}
						</button>
					@endif
				</td>
			</tr>					
		@endforeach
	</tbody>
</table>