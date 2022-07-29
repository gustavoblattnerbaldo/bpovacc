		{{ Form::open(array('url' => 'staff/' . $staff->userID, 'role' => 'form', 'method' => 'PUT', 'class' => 'solsoForm', 'data-alert' => isset($alert) ? $alert : false )) }}
		<div class="modal-dialog modal-md">
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title"> Editar Funcionário</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
		</div>

<div class="modal-body">
			<div class="row">
			<div class="form-group col-md-7">
				<label for="name">{{ trans('translate.name') }}</label>
				
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
					<input type="text" name="name" class="form-control required" autocomplete="off" data-parsley-errors-container=".group1" value="{{ $staff->name }}">
				</div>

				<div class="group1"></div>
				<?php echo $errors->first('name', '<p class="error">:messages</p>');?>
			</div>		
			
			<div class="form-group col-md-5">
				
				<label for="department">{{ trans('translate.department') }}</label>
				<select name="department" class="form-control required">
					<option value="{{ $staff->departmentID }}" selected>{{ $staff->department }}</option>
					<option value="">{{ trans('translate.choose') }}</option>
					
					@foreach ($departments as $d)
					<option value="{{ $d->id}}">{{ $d->name }}</option>
					@endforeach
				</select>
				
				<?php echo $errors->first('department', '<p class="error">:messages</p>');?>
			</div>

			<div class="form-group col-md-12">
				<label for="email">{{ trans('translate.email') }}</label>
				
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
					<input type="email" name="email" class="form-control required"autocomplete="off" data-parsley-errors-container=".group1" value="{{ $staff->email }}">
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
</div>
		{{ Form::close() }}		