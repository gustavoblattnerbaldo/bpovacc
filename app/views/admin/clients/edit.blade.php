<div class="col-md-12">
	<h1>
		{{ $client->name }}
	</h1>	

	<h3>{{ trans('translate.user_details') }}</h3>
	<div class="row">
		{{ Form::open(array('url' => 'client/' . $client->id, 'role' => 'form', 'method' => 'PUT', 'class' => 'solsoForm', 'data-alert' => isset($alert) ? $alert : false )) }}
		
			<div class="form-group col-md-4">
				<label for="name">{{ trans('translate.name') }}</label>
				
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
					<input type="text" name="name" class="form-control required" autocomplete="off" data-parsley-errors-container=".group1" value="{{ $client->name }}">
				</div>

				<div class="group1"></div>
				<?php echo $errors->first('name', '<p class="error">:messages</p>');?>
			</div>		
			
			<div class="form-group col-md-4">
				<label for="email">{{ trans('translate.email') }}</label>
				
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
					<input type="email" name="email" class="form-control required"autocomplete="off" data-parsley-errors-container=".group1" value="{{ $client->email }}">
				</div>

				<div class="group1"></div>
				<?php echo $errors->first('email', '<p class="error">:messages</p>');?>
			</div>
			
			<div class="form-group col-md-12">
				<input type="hidden" name="action" value="details">
				<button type="button" class="btn btn-success solsoSave" 
				data-message-title="{{ trans('translate.update_notification') }}" data-message-error="{{ trans('translate.validation_error_messages') }}" data-message-success="{{ trans('translate.data_was_updated') }}">
					<i class="fa fa-save"></i> {{ trans('translate.save') }}
				</button>
			</div>

		{{ Form::close() }}
	</div>	
	
	<h3>{{ trans('translate.change_user_password') }}</h3>	
	<div class="row">
		{{ Form::open(array('url' => 'client/' . $client->id, 'role' => 'form', 'method' => 'PUT', 'class' => 'solsoForm', 'data-alert' => isset($alert) ? $alert : false )) }}

			<div class="form-group col-md-4">
				<label for="new-password">{{ trans('translate.new_password') }}</label>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-lock"></i></span>
					<input type="password" name="new-password" class="form-control required" name="new-password" placeholder="new password" autocomplete="off" 
					data-parsley-minlength="6" data-parsley-errors-container=".group4">
				</div>

				<div class="group4"></div>
				<?php echo $errors->first('new-password', '<p class="error">:messages</p>');?>
			</div>
			<div class="clearfix"></div>

			<div class="form-group col-md-12">
				<input type="hidden" name="action" value="password">
				<button type="button" class="btn btn-success solsoSave" 
				data-message-title="{{ trans('translate.update_notification') }}" data-message-error="{{ trans('translate.validation_error_messages') }}" data-message-success="{{ trans('translate.data_was_updated') }}">
					<i class="fa fa-save"></i> {{ trans('translate.save') }}
				</button>
			</div>
		
		{{ Form::close() }}		
	</div>
</div>