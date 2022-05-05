{{ Form::open(array('url' => 'staff', 'role' => 'form', 'class' => 'solsoForm', 'data-alert' => isset($alert) ? $alert : false )) }}

	<div class="form-group col-md-4">
		<label for="name">{{ trans('translate.name') }}</label>
		<input type="text" name="name" class="form-control required" autocomplete="off" value="{{ Input::old('name') }}">

		<?php echo $errors->first('name', '<p class="error">:messages</p>');?>
	</div>

	<div class="col-md-4">
		<div class="form-group">
			<label for="email">{{ trans('translate.email') }}</label>
			<input type="email" name="email" class="form-control required" id="create_email" autocomplete="off" value="{{ Input::old('email') }}">
			
			<?php echo $errors->first('email', '<p class="error">:messages</p>');?>
		</div>
	</div>
	
	<div class="col-md-4">	
		<div class="form-group">
			<label for="department">{{ trans('translate.department') }}</label>
			<select name="department" class="form-control required">
				<option value="">{{ trans('translate.choose') }}</option>

				@foreach ($departments as $d)
					<option value="{{ $d->id}}">{{ $d->name }}</option>
				@endforeach
			</select>
			
			<?php echo $errors->first('department', '<p class="error">:messages</p>');?>
		</div>
	</div>
	
	<div class="form-group col-md-12">
		<button type="button" class="btn btn-success solsoSave" 
			data-message-title="{{ trans('translate.create_notification') }}" data-message-error="{{ trans('translate.validation_error_messages') }}" data-message-success="{{ trans('translate.data_was_saved') }}">
			<i class="fa fa-save"></i> {{ trans('translate.save') }}
		</button>
	</div>			
	
{{ Form::close() }}
