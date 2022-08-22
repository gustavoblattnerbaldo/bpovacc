<table class="table solsoTable table-striped" data-alert="{{ isset($alert) ? $alert : false }}" data-all="{{ sizeof($tickets) }}">
	<thead >
		<tr>
			<th>{{ trans('translate.crt') }}.</th>
			
			@if ( ! $userIsClient )
				<th class="col-md-2">{{ trans('translate.client') }}</th>
			@endif
			
			<!-- @if ( ! $userIsClient )	
				<th class="col-md-2">{{ trans('translate.assign_to') }}</th>
			@endif			 -->
			
			<th class="col-md-2">{{ trans('translate.title') }}</th>
			<th>{{ trans('translate.department') }}</th>
			<!--<th>{{ trans('translate.type') }}</th>-->
			<th>{{ trans('translate.priority') }}</th>
			<th>{{ trans('translate.status') }}</th>
			<th>Criado em</th>			
			<th>{{ trans('translate.state') }}</th>
			<th>Vencimento</th>			
			@if ( ! $userIsClient )
				<th class="text-center"></th>
			@endif
			
			@if ( $userIsClient )
				<th class="text-center"></th>
			@endif


		</tr>
	</thead>
	
	<tbody>

	@foreach ($tickets as $crt => $v)
		<tr>
			<td>
				<strong>
					{{ $crt+1 }}
				</strong>
			</td>

			@if ( ! $userIsClient )
				<td>
					<label class="label-client">{{ $v->client }}</label>
				</td>
			@endif
			
			<!-- @if ( ! $userIsClient )
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
			@endif -->
			
			<td>
				{{ $v->title }}
			</td>

			<td>
				{{ trans('translate.' . Language::translateSlug($v->department, '_')) }}
			</td>		
			
			<!--td>
				{{ trans('translate.' . Language::translateSlug($v->type, '_')) }}
			</td-->	

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

			<td>
				{{ $v->created_at }}
			</td>
			
			<td>
				@if ($v->state == 0)
					<label class="label-unread" >{{ trans('translate.unread') }}</label>
				@else
					<label class="label-read">{{ trans('translate.read') }}</label>
				@endif
			</td>	

			<td>
				{{ $v->created_at }}
			</td>

		<td class="action-table text-center">
			@if ( ! $userIsClient )
					<div class="dropdown">
						<button class="btn btn-geral solso-pdf dropdown-toggle" type="button" id="dropdownMenu1" title="Editar" data-toggle="dropdown" aria-expanded="true">
						<i class="fa fa-edit"></i>
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
			@endif


				<button type="button" class="btn btn-geral btn-info solsoShowModal" 
				data-toggle="modal" data-target="#solsoCrudModal" data-href="{{ URL::to('ticket/' . $v->id) }}" data-modal-title="{{ trans('translate.show_ticket') }}" title="Exibir">
					<i class="fa fa-eye"></i>
				</button>
			
			@if ( $userIsClient )		
					<button type="button" class="btn btn-geral solsoConfirm"
					data-toggle="modal" data-target="#solsoDeleteModal" data-href="{{ URL::to('ticket/' . $v->id) }}">
						<i class="fa fa-trash"></i>
					</button>	
			@endif
		</td>
		</tr>
	@endforeach
	
	</tbody>
</table>