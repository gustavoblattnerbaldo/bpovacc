<div class="col-md-12">
	<h3>{{ trans('translate.email_address_for_emails') }}</h3>
</div>

<div class="col-md-6 col-lg-4">	
	{{ Form::open(array('role' => 'form', 'class' => 'solsoForm')) }}	
		<div class="form-group">
			<label for="email">{{ trans('translate.email') }}</label>
			
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
				<input type="email" name="email" class="form-control required email" autocomplete="off" 
				data-parsley-errors-container=".groupEmail" value="{{ $company->receive_emails ? $company->receive_emails : $company->email }}">
			</div>

			<div class="groupEmail"></div>
			<?php echo $errors->first('email', '<p class="error">:messages</p>');?>
		</div>

		<div class="form-group">
			<input type="hidden" name="solsoStatus" value="{{ isset($status) ? $status : 'false'; }}">
			<button type="submit" class="btn btn-success solsoAjax" 
				data-href="{{ URL::to('admin/email') }}" data-method="post" data-return="tabEmail" 
				data-message-title="{{ trans('translate.update_notification') }}" data-message-error="{{ trans('translate.validation_error_messages') }}" data-message-success="{{ trans('translate.data_was_updated') }}">
				<i class="fa fa-save"></i> {{ trans('translate.save') }}
			</button>
		</div>

	{{ Form::close() }}
</div>