<div class="col-md-12">
	@if(Session::has('success'))
	<div class="col-md-3" style="
		position: absolute; 
		z-index: 1;
    right: 0%;
    margin-top: -40px;">
		<div role="alert" class="alert alert-success">
				<strong>{{ trans('translate.message') }}: </strong> {{ Session::get('success') }} !
			</div>	
	</div>	
	@endif	
	
	@if(Session::has('message'))
	<div class="col-md-3" style="
		position: absolute; 
		z-index: 1;
    right: 0%;
    margin-top: -40px;">
		<div role="alert" class="alert alert-info">
			<strong>{{ trans('translate.message') }}: </strong> {{ Session::get('message') }} !
		</div>
	</div>		
	@endif		

	@if(Session::has('warning'))
	<div class="col-md-3" style="
		position: absolute; 
		z-index: 1;
    right: 0%;
    margin-top: -40px;">
		<div role="alert" class="alert alert-warning">
			<strong>{{ trans('translate.message') }}: </strong> {{ Session::get('warning') }} !
		</div>	
	</div>	
	@endif	

	@if(Session::has('error'))
	<div class="col-md-3" style="
		position: absolute; 
		z-index: 1;
    right: 0%;
    margin-top: -40px;">
		<div role="alert" class="alert alert-danger">
			<strong>{{ trans('translate.message') }}: </strong> {{ Session::get('error') }} !
		</div>	
	</div>	
	@endif	

	{{ Session::forget('message') }}
</div>