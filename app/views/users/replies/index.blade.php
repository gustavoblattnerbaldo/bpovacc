@section('content')

	<div class="col-md-12">
		<h3>{{ trans('translate.replies') }}</h3>

		<div id="ajaxTable" class="table-responsive top20">
			@include('users.replies.table')	
		</div>	
	</div>
	
@stop