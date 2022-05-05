<div class="col-md-6 col-lg-4">
	<h3>{{ trans('translate.default_language') }}</h3>
	
	{{ Form::open(array('role' => 'form')) }}

		<div class="form-group">
			<select name="language" class="form-control required">
				
				@if (isset($defaultLanguage->name))
					<option value="{{ $defaultLanguage->id }}" selected> {{ $defaultLanguage->name }} </option>
					<option value="">{{ trans('translate.choose') }}</option>
				@else
					<option value="" selected>{{ trans('translate.choose') }}</option>
				@endif	
				
				@foreach ($languages as $v)
					<option value="{{ $v->id }}"> {{ $v->name }} </option>
				@endforeach			
				
			</select>
			
			<?php echo $errors->first('language', '<p class="error">:messages</p>');?>
		</div>

		<div class="form-group">
			<input type="hidden" name="solsoStatus" value="{{ isset($alert) ? $alert : 'false'; }}">
			<button type="submit" class="btn btn-success solsoAjax" 
				data-href="{{ URL::to('language/setDefault') }}" data-method="post" data-return="tabLanguage" 
				data-message-title="{{ trans('translate.create_notification') }}" data-message-error="{{ trans('translate.validation_error_messages') }}" 
				data-message-success="{{ trans('translate.data_was_saved') }}" data-message-warning="{{ trans('translate.value_already_exist') }}">
				<i class="fa fa-save"></i> {{ trans('translate.save') }}
			</button>
		</div>
	
	{{ Form::close() }}	
</div>	