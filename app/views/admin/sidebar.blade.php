<div id="solso-sidebar" class="list-group">
<a href="{{ URL::to('admin') }}" class="list-group-item <?php if ( Request::segment(1) == 'admin' && ! Request::segment(2)) { ?> active <?php } ?>">
		<div class="input-group">
			<h4 class="list-group-item-heading">Controle</h4>
		</div>	  
	</a>
	
	<a href="{{ URL::to('department') }}" class="list-group-item <?php if ( Request::segment(1) == 'department' ) { ?> active <?php } ?>">
		<div class="input-group">
			<h4 class="list-group-item-heading">Departamentos</h4>
		</div>	  
	</a>

	<a href="{{ URL::to('staff') }}" class="list-group-item <?php if ( Request::segment(1) == 'staff' ) { ?> active <?php } ?>">
		<div class="input-group">
			<h4 class="list-group-item-heading">Funcionários</h4>
		</div>	  
	</a>
	
	<a href="{{ URL::to('client') }}" class="list-group-item <?php if ( Request::segment(1) == 'client' ) { ?> active <?php } ?>">
		<div class="input-group">
			<h4 class="list-group-item-heading">Clientes</h4>
		</div>	  
	</a>	
	
	<a href="{{ URL::to('reply') }}" class="list-group-item <?php if ( Request::segment(1) == 'reply' ) { ?> active <?php } ?>">
		<div class="input-group">
			<h4 class="list-group-item-heading">Respostas</h4>
		</div>	  
	</a>	

	<a href="{{ URL::to('admin/settings') }}" class="list-group-item <?php if ( Request::segment(2) == 'settings' ) { ?> active <?php } ?>">
		<div class="input-group">
			<h4 class="list-group-item-heading">Configurações</h4>
		</div>	  
	</a>	
</div>