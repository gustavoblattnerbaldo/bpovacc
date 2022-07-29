<div class="col-md-6 col-lg-6">
	<h3>Alterar Senha</h3>
	
	{{ Form::open(array('role' => 'form')) }}
	
		<div class="form-group">
			<label for="old-password">Senha atual</label>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-lock"></i></span>
				<input type="password" name="old-password" class="form-control required" id="old-password" placeholder="Senha Atual" autocomplete="off" 
				data-parsley-minlength="6" data-parsley-errors-container=".group3">
			</div>

			<div class="group3"></div>
			<?php echo $errors->first('old-password', '<p class="error">:messages</p>');?>
		</div>

		<div class="form-group">
			<label for="new-password">{{ trans('translate.new_password') }}</label>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-lock"></i></span>
				<input type="password" name="new-password" class="form-control required" name="new-password" placeholder="Nova Senha" autocomplete="off" 
				data-parsley-minlength="6" data-parsley-errors-container=".group4">
			</div>

			<div class="group4"></div>
			<?php echo $errors->first('new-password', '<p class="error">:messages</p>');?>
		</div>

		<div class="form-group">
			<input type="hidden" name="action" value="password">
			<input type="hidden" name="solsoStatus" value="{{ isset($alert) ? $alert : 'false'; }}">
			<button type="submit" class="btn modal-btn-save solsoAjax" 
				data-href="{{ URL::to('user/' . Auth::id()) }}" data-method="put" data-return="tabPassword" 
				data-message-title="{{ trans('translate.create_notification') }}" data-message-error="{{ trans('translate.validation_error_messages') }}" 
				data-message-success="{{ trans('translate.data_was_saved') }}" data-message-warning="{{ trans('translate.old_password_not_match') }}">				
				<i class="fa fa-save"></i> {{ trans('translate.save') }}
			</button>
		</div>
	
	{{ Form::close() }}
</div>