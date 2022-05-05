<div id="solso-sidebar" class="list-group">
	<a href="{{ URL::to('admin') }}" class="list-group-item <?php if ( Request::segment(1) == 'admin' && ! Request::segment(2)) { ?> active <?php } ?>">
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-home"></i></span>
			<h4 class="list-group-item-heading">{{ trans('translate.dashboard') }}</h4>
			<p class="list-group-item-text">
				<label class="label-red">{{ $newTickets }} {{ trans('translate.new_tickets') }}</label>
			</p>
		</div>	  
	</a>
	
	<a href="{{ URL::to('department') }}" class="list-group-item <?php if ( Request::segment(1) == 'department' ) { ?> active <?php } ?>">
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-list"></i></span>
			<h4 class="list-group-item-heading">{{ trans('translate.departments') }}</h4>
			<p class="list-group-item-text">
				{{ trans('translate.create') }}  | {{ trans('translate.edit') }}  | {{ trans('translate.delete') }} 
			</p>
		</div>	  
	</a>

	<a href="{{ URL::to('staff') }}" class="list-group-item <?php if ( Request::segment(1) == 'staff' ) { ?> active <?php } ?>">
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-users"></i></span>
			<h4 class="list-group-item-heading">{{ trans('translate.staff') }}</h4>
			<p class="list-group-item-text">
				{{ trans('translate.create') }}  | {{ trans('translate.edit') }}  | {{ trans('translate.delete') }} 
			</p>
		</div>	  
	</a>
	
	<a href="{{ URL::to('client') }}" class="list-group-item <?php if ( Request::segment(1) == 'client' ) { ?> active <?php } ?>">
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-users"></i></span>
			<h4 class="list-group-item-heading">{{ trans('translate.clients') }}</h4>
			<p class="list-group-item-text">
				{{ trans('translate.create') }}  | {{ trans('translate.edit') }}  | {{ trans('translate.delete') }} 
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
	
	<a href="{{ URL::to('language') }}" class="list-group-item <?php if ( Request::segment(1) == 'language' ) { ?> active <?php } ?>">
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-book"></i></span>
			<h4 class="list-group-item-heading">{{ trans('translate.languages') }}</h4>
			<p class="list-group-item-text">
				{{ trans('translate.create') }} | {{ trans('translate.edit') }} | {{ trans('translate.delete') }}
			</p>
		</div>	  
	</a>

	<a href="{{ URL::to('admin/settings') }}" class="list-group-item <?php if ( Request::segment(2) == 'settings' ) { ?> active <?php } ?>">
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-cogs"></i></span>
			<h4 class="list-group-item-heading">{{ trans('translate.settings') }}</h4>
			<p class="list-group-item-text">
				{{ trans('translate.create') }} | {{ trans('translate.edit') }} | {{ trans('translate.delete') }}
			</p>
		</div>	  
	</a>	
</div>