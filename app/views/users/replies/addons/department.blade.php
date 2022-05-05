{{ Form::open(array('url' => 'ticket/' . $ticket->id . '/department', 'role' => 'form', 'method' => 'POST', 'class' => 'solsoForm', 'data-alert' => isset($alert) ? $alert : false )) }}

	<div class="form-group col-md-4">
		<label for="department">{{ trans('translate.department') }}</label>
		<select name="department" class="form-control required">
			<option value="" selected>{{ trans('translate.choose') }}</option>
			
			@foreach ($departments as $v)
				<option value="{{ $v->id }}"> {{ $v->name }} </option>
			@endforeach					
			
		</select>

		<?php echo $errors->first('department', '<p class="error">:messages</p>');?>
	</div>

	<div class="form-group col-md-12">
		<button type="button" class="btn btn-success solsoSave" 
		data-message-title="{{ trans('translate.update_notification') }}" data-message-error="{{ trans('translate.validation_error_messages') }}" data-message-success="{{ trans('translate.data_was_updated') }}">
			<i class="fa fa-save"></i> {{ trans('translate.save') }}
		</button>
	</div>
	
{{ Form::close() }}