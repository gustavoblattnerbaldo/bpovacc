<div id="solso-sidebar" class="list-group">
	@if ($user->role_id == 2)
		<a href="{{ URL::to('dashboard') }}">
			<div class="input-group list-group-item-sidebar-menu <?php if ( Request::segment(1) == 'dashboard' && ! Request::segment(2)) { ?> active <?php } ?>">
				<h4 class="list-group-item-sidebar-menu-heading">Controle</h4>
			</div>	  
		</a>
	@endif
	
	<a href="{{ URL::to('ticket') }}">
		<div class="input-group list-group-item-sidebar-menu <?php if ( Request::segment(1) == 'ticket' ) { ?> active <?php } ?>">
			<h4 class="list-group-item-sidebar-menu-heading">Chamados</h4>
		</div>	  
	</a>	
	
	<a href="{{ URL::to('reply') }}">
		<div class="input-group list-group-item-sidebar-menu <?php if ( Request::segment(1) == 'reply' ) { ?> active <?php } ?>">
			<h4 class="list-group-item-sidebar-menu-heading">Acompanhamento</h4>
		</div>	  
	</a>

	<a href="https://shorturl.at/acNSX" target="_blank" rel="noopener noreferrer">
		<div class="input-group list-group-item-sidebar-menu <?php if ( Request::segment(1) == 'planning' ) { ?> active <?php } ?>">
			<h4 class="list-group-item-sidebar-menu-heading">Planejamento</h4>
		</div>	  
	</a>
	
	<a href="{{ URL::to('settings') }}">
		<div class="input-group list-group-item-sidebar-menu <?php if ( Request::segment(1) == 'settings' ) { ?> active <?php } ?>">
			<h4 class="list-group-item-sidebar-menu-heading">Configurações</h4>
		</div>	  
	</a>	
</div>