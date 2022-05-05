<div class="col-md-12">
	
	<h3>{{ trans('translate.department') }}</h3>	
	<div class="row">
		{{ Form::open(array('url' => 'department/' . $department->id, 'role' => 'form', 'method' => 'PUT', 'class' => 'solsoForm', 'data-alert' => isset($alert) ? $alert : false )) }}

			<div class="form-group col-md-4">
				<label for="name">{{ trans('translate.name') }}</label>
				<input type="text" name="name" class="form-control required" autocomplete="off" value="{{ trans('translate.' . Language::translateSlug($department->name, '_')) }}">

				<?php echo $errors->first('name', '<p class="error">:messages</p>');?>
			</div>

			<div class="form-group col-md-12">
				<input type="hidden" name="oldValue" value="{{ $department->name }}">
				<button type="button" class="btn btn-success solsoSave" 
				data-message-title="{{ trans('translate.update_notification') }}" data-message-error="{{ trans('translate.validation_error_messages') }}" data-message-success="{{ trans('translate.data_was_updated') }}">
					<i class="fa fa-save"></i> {{ trans('translate.save') }}
				</button>
			</div>
		
		{{ Form::close() }}		
	</div>
</div>