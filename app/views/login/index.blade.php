@include('begin')
	@include('login.navbar')

	@include('assets.messages.alerts')
	
	@yield('content')

@include('end')