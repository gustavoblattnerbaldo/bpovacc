@include('begin')

<div class="container">
<div class="row">
	<div class="col-md-12">
		<div role="alert" class="alert alert-error top20 text-center">
			<h1>{{ trans('translate.error404') }}</h1>
			
			<a href="<?php echo URL::to('/');?>" class="btn btn-primary">
				{{ trans('translate.error404') }} <i class="fa fa-long-arrow-right"></i>
			</a>
		</div>	
	</div>
</div>
</div>

@include('end')

