<div class="col-md-6 col-lg-4">
	<h3>{{ trans('translate.details') }}</h3>

	{{ Form::open(array('role' => 'form')) }}
	
		<div class="form-group">
			<label for="name">{{ trans('translate.name') }}</label>
			<input type="text" name="name" class="form-control required" autocomplete="off" value="{{ $user->name }}">

			<?php echo $errors->first('name', '<p class="error">:messages</p>');?>
		</div>

		<div class="form-group">
			<input type="hidden" name="action" value="details">
			<input type="hidden" name="solsoStatus" value="{{ isset($alert) ? $alert : 'false'; }}">
			<button type="submit" class="btn btn-success solsoAjax" 
				data-href="{{ URL::to('user/' . Auth::id()) }}" data-method="put" data-return="tabDetails" 
				data-message-title="{{ trans('translate.update_notification') }}" data-message-error="{{ trans('translate.validation_error_messages') }}" data-message-success="{{ trans('translate.data_was_updated') }}">
				<i class="fa fa-save"></i> {{ trans('translate.save') }}
			</button>
		</div>	
	
	{{ Form::close() }}
</div>