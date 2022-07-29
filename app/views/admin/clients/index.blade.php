@section('content')
<div class="col-md-12">
<h3>{{ trans('translate.clients') }}</h3>
</div>
	<div class="col-md-12">
		<button type="button" class="btn btn-position-right solsoShowModal" 
		data-toggle="modal" data-target="#solsoCrudModal" data-href="{{ URL::to('client/create') }}" data-modal-title="Criar Departamento">
			<i class="fa fa-user-plus"></i> Novo Cliente
		</button>		
	</div>		

	<div class="col-md-12 top20">
		<div id="ajaxTable" class="table-responsive">
			@include('admin.clients.table')	
		</div>	
	</div>

@stop