@include('begin')

<header>
	@include('admin.navbar')
</header>

<main class="body slide">
	<aside class="sidebar show perfectScrollbar">
		@include('admin.sidebar')
	</aside>
	
	<div class="container-fluid">
	<div class="row">
		@yield('content')
		
		@include('assets.modals.modal-ban')
		@include('assets.modals.modal-remove-ban')
		@include('assets.modals.modal-crud')
		@include('assets.modals.modal-delete')		
	</div>
	</div>
</main>

@include('end')