@section('content')
<div class="col-md-12">
<h3>{{ trans('translate.departments') }}</h3>
</div>
	<div class="col-md-12">
		<button type="button" class="btn btn-position-right solsoShowModal" 
		data-toggle="modal" data-target="#solsoCrudModal" data-href="{{ URL::to('department/create') }}" data-modal-title="Criar Departamento">
			<i class="fa fa-plus"></i> Novo Departamento
		</button>		
	</div>		

	<div class="col-md-12 top20">
		<div id="ajaxTable" class="table-responsive">
			@include('admin.departments.table')	
		</div>	
	</div>

@stop
