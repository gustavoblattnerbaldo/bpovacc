@section('content')

	<div class="col-md-12">
		<h1>
			<i class="fa fa-users"></i> {{ trans('translate.staff') }}
		</h1>

		<button type="button" class="btn btn-primary solsoShowModal" 
		data-toggle="modal" data-target="#solsoCrudModal" data-href="{{ URL::to('staff/create') }}" data-modal-title="{{ trans('translate.create_new_staff') }}">
			<i class="fa fa-user-plus"></i> {{ trans('translate.create_new_staff') }}
		</button>		
	</div>		

	<div class="col-md-12 top40">
		<h3>{{ trans('translate.staff') }}</h3>

		<div id="ajaxTable" class="table-responsive">
			@include('admin.staff.table')	
		</div>	
	</div>
	
@stop
