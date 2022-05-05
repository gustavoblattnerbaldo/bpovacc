{{ Form::open(array('url' => 'language/' . Request::segment(2), 'role' => 'form', 'method' => 'PUT', 'class' => 'solsoForm', 'data-alert' => isset($alert) ? $alert : false )) }}
	
	<div class="form-group col-md-6">
		<label for="name">{{ trans('translate.name') }}</label>
		<input type="text" name="name" class="form-control required" autocomplete="off" value="{{ Input::old('name') ? Input::old('name') : $language->name }}">

		<?php echo $errors->first('name', '<p class="error">:messages</p>');?>
	</div>
	
	<div class="form-group col-md-12">
		<button type="button" class="btn btn-success solsoSave"
		data-message-title="{{ trans('translate.create_notification') }}" data-message-error="{{ trans('translate.validation_error_messages') }}" data-message-success="{{ trans('translate.data_was_updated') }}">
			<i class="fa fa-save"></i> {{ trans('translate.save') }}
		</button>	
	</div>
	
{{ Form::close() }}
