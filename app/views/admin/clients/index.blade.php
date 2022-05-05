@section('content')

	<div class="col-md-12">
		<h1>
			<i class="fa fa-users"></i> {{ trans('translate.clients') }}
		</h1>

		@if (!$invitation)
			<div role="alert" class="alert alert-warning top20">
				<strong>{{ trans('translate.message') }}: </strong> {{ trans('translate.no_invitation') }}
				{{ trans('translate.go_to') }} <a href="{{ URL::to('admin/settings') }}">{{ trans('translate.settings') }}</a>
			</div>
		@endif
		
		<button type="button" class="btn btn-primary solsoShowModal" 
		data-toggle="modal" data-target="#solsoCrudModal" data-href="{{ URL::to('client/create') }}" data-modal-title="{{ trans('translate.create_new_client') }}">
			<i class="fa fa-user-plus"></i> {{ trans('translate.create_new_client') }}
		</button>		
	</div>		

	<div class="col-md-12 top40">
		<h3>{{ trans('translate.clients') }}</h3>

		<div id="ajaxTable" class="table-responsive">
			@include('admin.clients.table')	
		</div>	
	</div>
	
@stop
