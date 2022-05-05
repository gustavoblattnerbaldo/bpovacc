<table class="table solsoTable" data-alert="{{ isset($alert) ? $alert : false }}" data-all="{{ sizeof($tickets) }}">
	<thead>
		<tr>
			<th>{{ trans('translate.crt') }}.</th>
			
			@if ( ! $userIsClient )
				<th class="col-md-2">{{ trans('translate.client') }}</th>
			@endif
			
			@if ( ! $userIsClient )	
				<th class="col-md-2">{{ trans('translate.assign_to') }}</th>
			@endif			
			
			<th>{{ trans('translate.title') }}</th>
			<th class="small">{{ trans('translate.department') }}</th>
			<th class="small">{{ trans('translate.type') }}</th>
			<th class="small">{{ trans('translate.priority') }}</th>
			<th class="small">{{ trans('translate.status') }}</th>
			<th class="small text-center">{{ trans('translate.created_at') }}</th>			
			<th class="small">{{ trans('translate.state') }}</th>
			
			@if ( ! $userIsClient )
				<th class="small">{{ trans('translate.action') }}</th>
				<th class="small">{{ trans('translate.action') }}</th>
			@endif
			
			@if ( $userIsClient )
				<th class="small">{{ trans('translate.action') }}</th>
				<th class="small">{{ trans('translate.action') }}</th>
			@endif
		</tr>
	</thead>
	
	<tbody>

	@foreach ($tickets as $crt => $v)
		<tr>
			<td>
				{{ $crt+1 }}
			</td>

			@if ( ! $userIsClient )
				<td>
					<label class="label-client">{{ $v->client }}</label>
				</td>
			@endif
			
			@if ( ! $userIsClient )
				<td>
					@if ($v->staff_id == 0)
						<label class="label-green">{{ trans('translate.free') }}</label>
					@else
						<label class="label-owner">
							@if ($user->role_id == 1)
								{{ $v->staff }}
							@else
								{{ $user->name }}
							@endif
						</label>
					@endif		
				</td>
			@endif
			
			<td>
				{{ $v->title }}
			</td>

			<td>
				{{ trans('translate.' . Language::translateSlug($v->department, '_')) }}
			</td>		
			
			<td>
				{{ trans('translate.' . Language::translateSlug($v->type, '_')) }}
			</td>	

			<td>
				{{ trans('translate.' . Language::translateSlug($v->priority, '_')) }}
			</td>
			
			<td>
				@if ($v->status_id == 0)
					{{ trans('translate.processing') }}
				@else
					{{ trans('translate.' . Language::translateSlug($v->status, '_')) }}
				@endif
			</td>			

			<td class="text-center">
				{{ $v->created_at }}
			</td>
			
			<td>
				@if ($v->state == 0)
					<label class="label-orange">{{ trans('translate.unread') }}</label>
				@else
					<label class="label-green">{{ trans('translate.read') }}</label>
				@endif
			</td>			
			
			@if ( ! $userIsClient )
				<td>
					<div class="dropdown">
						<button class="btn solso-pdf dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
							{{ trans('translate.quick_actions') }}
							<span class="caret"></span>
						</button>
					
						<ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdownMenu1">
							<li role="presentation">
								<a role="menuitem" tabindex="-1" href="#" class="solsoShowModal" data-toggle="modal" 
								data-target="#solsoCrudModal" data-href="{{ URL::to('ticket/' . $v->id . '/department') }}" data-modal-title="{{ trans('translate.change_department') }}">
									{{ trans('translate.change_department') }}
								</a>
							</li>							
							
							<li role="presentation">
								<a role="menuitem" tabindex="-1" href="#" class="solsoShowModal" data-toggle="modal" 
								data-target="#solsoCrudModal" data-href="{{ URL::to('ticket/' . $v->id . '/status') }}" data-modal-title="{{ trans('translate.change_status') }}">
									{{ trans('translate.change_status') }}
								</a>
							</li>
							
							<li role="presentation">
								<a role="menuitem" tabindex="-1" href="#" class="solsoShowModal" data-toggle="modal" 
								data-target="#solsoCrudModal" data-href="{{ URL::to('ticket/' . $v->id . '/priority') }}" data-modal-title="{{ trans('translate.change_priority') }}">
									{{ trans('translate.change_priority') }}
								</a>							
							</li>
							
							@if ( $user->role_id == 1 )
								<li class="divider"></li>
								<li role="presentation">
									<a role="menuitem" tabindex="-1" href="#" class="solsoShowModal" data-toggle="modal" 
									data-target="#solsoCrudModal" data-href="{{ URL::to('ticket/' . $v->id . '/workers') }}" data-modal-title="{{ trans('translate.assign_ticket') }}">
										{{ trans('translate.assign_ticket') }}
									</a>
								</li>
							@endif							
							
							@if ( $user->role_id == 2 && $v->staff_id == 0 )
								<li class="divider"></li>
								<li role="presentation">
									<a role="menuitem" tabindex="-1" href="#" class="solsoShowModal" data-toggle="modal" 
									data-target="#solsoCrudModal" data-href="{{ URL::to('ticket/' . $v->id . '/workers') }}" data-modal-title="{{ trans('translate.work_on_this_ticket') }}">
										{{ trans('translate.work_on_this_ticket') }}
									</a>
								</li>
							@endif
						</ul>
					</div>
				</td>
			@endif

			<td>
				<button type="button" class="btn btn-info solsoShowModal" 
				data-toggle="modal" data-target="#solsoCrudModal" data-href="{{ URL::to('ticket/' . $v->id) }}" data-modal-title="{{ trans('translate.show_ticket') }}">
					<i class="fa fa-eye"></i> {{ trans('translate.show') }}
				</button>
			</td>	
			
			@if ( $userIsClient )
				<td>		
					<button type="button" class="btn btn-danger solsoConfirm" 
					data-toggle="modal" data-target="#solsoDeleteModal" data-href="{{ URL::to('ticket/' . $v->id) }}">
						<i class="fa fa-trash"></i> {{ trans('translate.delete') }}
					</button>
				</td>		
			@endif
		</tr>
	@endforeach
	
	</tbody>
</table>