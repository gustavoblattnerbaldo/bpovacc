<div class="col-md-6 col-lg-4">
	<h3>{{ trans('translate.change_user') }}</h3>

	{{ Form::open(array('role' => 'form')) }}
	
		<div class="form-group">
			<label for="email">{{ trans('translate.email') }}</label>
			
			<div class="input-group">
				<span class="input-group-addon">
					<i class="fa fa-envelope"></i>
				</span>
				<input type="email" name="email" class="form-control required email" id="email" placeholder="email address" autocomplete="off" 
				data-parsley-errors-container=".group1">
			</div>

			<div class="group1"></div>
			<?php echo $errors->first('email', '<p class="error">:messages</p>');?>
		</div>

		<div class="form-group">
			<label for="repeat-email">{{ trans('translate.repeat_email') }}</label>
			
			<div class="input-group">
				<span class="input-group-addon">
					<i class="fa fa-envelope"></i>
				</span>
				<input type="email" name="repeat-email" class="form-control required email" id="repeat-email" placeholder="repeat email address" autocomplete="off" 
				data-parsley-equalto="#email" data-parsley-errors-container=".group2">
			</div>

			<div class="group2"></div>
			<?php echo $errors->first('repeat-email', '<p class="error">:messages</p>');?>
		</div>

		<div class="form-group">
			<input type="hidden" name="action" value="email">
			<input type="hidden" name="solsoStatus" value="{{ isset($alert) ? $alert : 'false'; }}">
			<button type="submit" class="btn btn-success solsoAjax" 
				data-href="{{ URL::to('user/' . Auth::id()) }}" data-method="put" data-return="tabAccount" 
				data-message-title="{{ trans('translate.update_notification') }}" data-message-error="{{ trans('translate.validation_error_messages') }}" data-message-success="{{ trans('translate.data_was_updated') }}">
				<i class="fa fa-save"></i> {{ trans('translate.save') }}
			</button>
		</div>	
	
	{{ Form::close() }}
</div>