@section('content')

	<div class="col-md-12">
		<h1>
			<i class="fa fa-comments"></i> {{ trans('translate.replies') }}
		</h1>
	</div>	

	<div class="col-md-12 top40">
		<h3>{{ trans('translate.replies') }}</h3>

		<div id="ajaxTable" class="table-responsive">
			@include('users.replies.table')	
		</div>	
	</div>
	
@stop