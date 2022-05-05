@section('content')

	<div class="col-md-12 ">
		<h1>
			<i class="fa fa-book"></i> {{ trans('translate.languages') }}
		</h1>
		
		<button type="button" class="btn btn-primary solsoShowModal" 
		data-toggle="modal" data-target="#solsoCrudModal" data-href="{{ URL::to('language/create') }}" data-modal-title="{{ trans('translate.create_new_language') }}">
			<i class="fa fa-plus"></i> {{ trans('translate.create_new_language') }}
		</button>
	</div>	

	
	<div class="col-md-12 top40">
		<h3>{{ trans('translate.languages') }}</h3>

		<div id="ajaxTable" class="table-responsive">
			@include('admin.languages.table')	
		</div>	
	</div>
	
@stop