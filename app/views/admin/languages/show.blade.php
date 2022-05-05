@section('content')
	
	<div class="col-md-12 ">
		<h1><i class="fa fa-plus"></i> {{ trans('translate.translate_language') }}</h1>
	</div>		

	{{ Form::open(array('url' => 'language/translate', 'role' => 'form', 'class' => 'solsoForm')) }}
	
	<div class="col-md-12 ">
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th class="col-md-6">{{ trans('translate.original_language') }}</th>
					<th class="col-md-6">{{ trans('translate.translate_language') }}</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($original as $k => $v)
				
				<tr>
					<td>
						{{ $v }}
					</th>
					
					<td>
						<input type="text" name="words[{{ $k }}]" class="form-control required" value="{{ isset($translated[$k]) ? $translated[$k] : $v }}">
					</th>
				</tr>
				
				@endforeach
			</tbody>	
			
			<tfoot>
				<tr>
					<td colspan="2">
						<input type="hidden" name="languageID" value="{{ Request::segment(2) }}">
						<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> {{ trans('translate.save') }}</button>
					</td>
				</tr>
			</tfoot>
		</table>		
	</div>	
	</div>	

	{{ Form::close() }}
	
@stop
