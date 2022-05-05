<div class="col-md-12">
	@if(Session::has('success'))
		<div role="alert" class="alert alert-success top20">
			<strong>{{ trans('translate.message') }}: </strong> {{ Session::get('success') }} !
		</div>		
	@endif	
	
	@if(Session::has('message'))
		<div role="alert" class="alert alert-info top20">
			<strong>{{ trans('translate.message') }}: </strong> {{ Session::get('message') }} !
		</div>		
	@endif		

	@if(Session::has('warning'))
		<div role="alert" class="alert alert-warning top20">
			<strong>{{ trans('translate.message') }}: </strong> {{ Session::get('warning') }} !
		</div>		
	@endif	

	@if(Session::has('error'))
		<div role="alert" class="alert alert-danger top20">
			<strong>{{ trans('translate.message') }}: </strong> {{ Session::get('error') }} !
		</div>		
	@endif	

	{{ Session::forget('message') }}
</div>