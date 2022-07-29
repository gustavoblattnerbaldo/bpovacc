@section('content')
<div class="col-md-12">
<h3>{{ trans('translate.staff') }}</h3>
</div>
	<div class="col-md-12">
		<button type="button" class="btn btn-position-right solsoShowModal" 
		data-toggle="modal" data-target="#solsoCrudModal" data-href="{{ URL::to('staff/create') }}" data-modal-title="Criar Funcionário">
			<i class="fa fa-plus"></i> Novo Funcionário
		</button>		
	</div>		

	<div class="col-md-12 top20">
		<div id="ajaxTable" class="table-responsive">
			@include('admin.staff.table')	
		</div>	
	</div>

@stop