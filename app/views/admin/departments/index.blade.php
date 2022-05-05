@section('content')

	<div class="col-md-12">
		<h1>
			<i class="fa fa-list"></i> {{ trans('translate.departments') }}
		</h1>

		<button type="button" class="btn btn-primary solsoShowModal" 
		data-toggle="modal" data-target="#solsoCrudModal" data-href="{{ URL::to('department/create') }}" data-modal-title="{{ trans('translate.create_new_staff') }}">
			<i class="fa fa-plus"></i> {{ trans('translate.create_new_department') }}
		</button>		
	</div>		

	<div class="col-md-12 top40">
		<h3>{{ trans('translate.departments') }}</h3>

		<div id="ajaxTable" class="table-responsive">
			@include('admin.departments.table')	
		</div>	
	</div>

@stop
