{{ Form::open(array('url' => 'staff/' . $staff->userID, 'role' => 'form', 'method' => 'PUT', 'class' => 'solsoForm', 'data-alert' => isset($alert) ? $alert : false )) }}
<div class="modal-dialog modal-md">
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title"> Alterar Senha do Funcionário</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
		</div>

		<div class="modal-body">
					<div class="row">
					<div class="form-group col-md-8">
						<label for="new-password">{{ trans('translate.new_password') }}</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-lock"></i></span>
							<input type="password" name="new-password" class="form-control required" name="new-password" placeholder="Nova Senha" autocomplete="off" 
							data-parsley-minlength="6" data-parsley-errors-container=".group4">
						</div>

						<div class="group4"></div>
						<?php echo $errors->first('new-password', '<p class="error">:messages</p>');?>
					</div>
					<div class="clearfix"></div>
					</div>
		</div>
				<div class="modal-footer">
				<input type="hidden" name="action" value="password">
				<button type="button" class="btn modal-btn-save solsoSave" 
						data-message-title="{{ trans('translate.update_notification') }}" data-message-error="{{ trans('translate.validation_error_messages') }}" data-message-success="{{ trans('translate.data_was_updated') }}">
							<i class="fa fa-save"></i> {{ trans('translate.save') }}
						</button>
					<button type="reset" class="btn btn-default" data-dismiss="modal">
						{{ trans('translate.cancel') }}
					</button>
				</div>
				</div>
		</div>
		{{ Form::close() }}		