{{ Form::open(array('url' => 'client/' . $client->id, 'role' => 'form', 'method' => 'PUT', 'class' => 'solsoForm', 'data-alert' => isset($alert) ? $alert : false )) }}
<div class="modal-dialog modal-md">
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title"> Editar Cliente</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
		</div>

		<div class="modal-body">
			<div class="row">
			<div class="form-group col-md-12">
				<label for="name">{{ trans('translate.name') }}</label>
				
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
					<input type="text" name="name" class="form-control required" autocomplete="off" data-parsley-errors-container=".group1" value="{{ $client->name }}">
				</div>

				<div class="group1"></div>
				<?php echo $errors->first('name', '<p class="error">:messages</p>');?>
			</div>		
			
			<div class="form-group col-md-12">
				<label for="email">{{ trans('translate.email') }}</label>
				
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
					<input type="email" name="email" class="form-control required"autocomplete="off" data-parsley-errors-container=".group1" value="{{ $client->email }}">
				</div>

				<div class="group1"></div>
				<?php echo $errors->first('email', '<p class="error">:messages</p>');?>
			</div>
			</div>
		</div>
			<div class="modal-footer">
			<input type="hidden" name="action" value="details">
				<button type="button" class="btn modal-btn-save solsoSave" 
						data-message-title="{{ trans('translate.update_notification') }}" data-message-error="{{ trans('translate.validation_error_messages') }}" data-message-success="{{ trans('translate.data_was_updated') }}">
							<i class="fa fa-save"></i> {{ trans('translate.save') }}
						</button>
					<button type="reset" class="btn btn-default" data-dismiss="modal">
						{{ trans('translate.cancel') }}
					</button>
				</div>
				</div>

		{{ Form::close() }}

