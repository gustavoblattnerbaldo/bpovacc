<div id="solso-sidebar" class="list-group">
	@if ($user->role_id == 2)
		<a href="{{ URL::to('dashboard') }}" class="list-group-item <?php if ( Request::segment(1) == 'dashboard' && ! Request::segment(2)) { ?> active <?php } ?>">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-home"></i></span>
				<h4 class="list-group-item-heading">{{ trans('translate.dashboard') }}</h4>
				<p class="list-group-item-text">
					{{ trans('translate.reports') }}
				</p>
			</div>	  
		</a>
	@endif
	
	<a href="{{ URL::to('ticket') }}" class="list-group-item <?php if ( Request::segment(1) == 'ticket' ) { ?> active <?php } ?>">
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-comment"></i></span>
			<h4 class="list-group-item-heading">{{ trans('translate.tickets') }}</h4>
			<p class="list-group-item-text">
				@if ($userIsClient)
					<p class="list-group-item-text">
						{{ trans('translate.create') }} | {{ trans('translate.view') }} | {{ trans('translate.delete') }}
					</p>
				@else	
					<label class="label-red">
						<span class="span-new-ticket">{{ $newTickets }}</span>
						{{ trans('translate.new_tickets') }}
					</label>
				@endif
			</p>
		</div>	  
	</a>	
	
	<a href="{{ URL::to('reply') }}" class="list-group-item <?php if ( Request::segment(1) == 'reply' ) { ?> active <?php } ?>">
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-comments"></i></span>
			<h4 class="list-group-item-heading">{{ trans('translate.replies') }}</h4>
			<p class="list-group-item-text">
				<label class="label-red">
					<span class="span-new-reply">{{ $newReplies }}</span>
					{{ trans('translate.new_replies') }}
				</label>
			</p>
		</div>	  
	</a>
	
	<a href="{{ URL::to('settings') }}" class="list-group-item <?php if ( Request::segment(1) == 'settings' ) { ?> active <?php } ?>">
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-cogs"></i></span>
			<h4 class="list-group-item-heading">{{ trans('translate.settings') }}</h4>
			<p class="list-group-item-text">
				{{ trans('translate.update_personal_data') }}
			</p>
		</div>	  
	</a>	
</div>