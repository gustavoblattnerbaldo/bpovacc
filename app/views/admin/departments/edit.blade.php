{{ Form::open(array('url' => 'department/' . $department->id, 'role' => 'form', 'method' => 'PUT', 'class' => 'solsoForm', 'data-alert' => isset($alert) ? $alert : false )) }}
<div class="modal-dialog modal-md">
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title"> Editar Departamento</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
		</div>

<div class="modal-body">
			<div class="row">
				<div class="form-group col-md-8">
					<label for="name">{{ trans('translate.name') }}</label>
					<input type="text" name="name" class="form-control required" autocomplete="off" value="{{ $department->name }}">

					<?php echo $errors->first('name', '<p class="error">:messages</p>');?>
				</div>
			</div>
		</div>
		
		<div class="modal-footer">
		<button type="button" class="btn modal-btn-save solsoSave" 
						data-message-title="{{ trans('translate.create_notification') }}" data-message-error="{{ trans('translate.validation_error_messages') }}" data-message-success="{{ trans('translate.data_was_saved') }}">
						<i class="fa fa-save"></i> {{ trans('translate.save') }}
					</button>
			<button type="reset" class="btn btn-default" data-dismiss="modal">
				{{ trans('translate.cancel') }}
			</button>
		</div>
		</div>
</div>
{{ Form::close() }}

