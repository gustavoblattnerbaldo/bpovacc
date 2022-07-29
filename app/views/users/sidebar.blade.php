<div id="solso-sidebar" class="list-group">
	@if ($user->role_id == 2)
		<a href="{{ URL::to('dashboard') }}" class="list-group-item <?php if ( Request::segment(1) == 'dashboard' && ! Request::segment(2)) { ?> active <?php } ?>">
			<div class="input-group">
				<h4 class="list-group-item-heading">Controle</h4>
			</div>	  
		</a>
	@endif
	
	<a href="{{ URL::to('ticket') }}" class="list-group-item <?php if ( Request::segment(1) == 'ticket' ) { ?> active <?php } ?>">
		<div class="input-group">
			<h4 class="list-group-item-heading">Tickets</h4>
		</div>	  
	</a>	
	
	<a href="{{ URL::to('reply') }}" class="list-group-item <?php if ( Request::segment(1) == 'reply' ) { ?> active <?php } ?>">
		<div class="input-group">
			<h4 class="list-group-item-heading">Respostas</h4>
		</div>	  
	</a>
	
	<a href="{{ URL::to('settings') }}" class="list-group-item <?php if ( Request::segment(1) == 'settings' ) { ?> active <?php } ?>">
		<div class="input-group">
			<h4 class="list-group-item-heading">Configurações</h4>
		</div>	  
	</a>	
</div>