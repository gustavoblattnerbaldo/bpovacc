{{ Form::open(array('url' => 'ticket', 'role' => 'form', 'class' => 'solsoForm')) }}
	
	<div class="form-group col-md-6">
		<label for="title"> {{ trans('translate.title') }} </label>
		<input type="text" name="title" class="form-control required" autocomplete="off" value="{{ isset($inputs['title']) ? $inputs['title'] : '' }}">

		<?php echo $errors->first('title', '<p class="error">:messages</p>');?>
	</div>		
	
	<div class="form-group col-md-2">
		<label for="department_id">{{ trans('translate.department') }}</label>
		<select name="department_id" class="form-control required">
			<option value="" selected>{{ trans('translate.choose') }}</option>
			
			@foreach ($departments as $d)
				<option value="{{ $d->id }}">{{ trans('translate.' . Language::translateSlug($d->name, '_')) }}</option>
			@endforeach			
			
		</select>
		
		<?php echo $errors->first('department_id', '<p class="error">:messages</p>');?>
	</div>	
	
	<div class="form-group col-md-2">
		<label for="type_id">{{ trans('translate.ticket_type') }}</label>
		<select name="type_id" class="form-control required">
			<option value="" selected>{{ trans('translate.choose') }}</option>
			
			@foreach ($types as $t)
				<option value="{{ $t->id }}">{{ trans('translate.' . Language::translateSlug($t->name, '_')) }}</option>
			@endforeach			
			
		</select>
		
		<?php echo $errors->first('type_id', '<p class="error">:messages</p>');?>
	</div>	
	
	<div class="form-group col-md-2">
		<label for="priority_id">{{ trans('translate.priority') }}</label>
		<select name="priority_id" class="form-control required">
			<option value="" selected>{{ trans('translate.choose') }}</option>
			
			@foreach ($priorities as $p)
				<option value="{{ $p->id }}">{{ trans('translate.' . Language::translateSlug($p->name, '_')) }}</option>
			@endforeach			

		</select>
		
		<?php echo $errors->first('priority_id', '<p class="error">:messages</p>');?>
	</div>
	
	<div class="form-group col-md-12">
		<label for="content"> {{ trans('translate.message') }} </label>
		<textarea name="content" class="form-control solsoEditor" rows="7" autocomplete="off">{{ isset($inputs['content']) ? $inputs['content'] : '' }}</textarea>
		
		<?php echo $errors->first('content', '<p class="error">:messages</p>');?>
	</div>	

	<div class="form-group col-md-12">
		<button type="button" class="btn btn-success solsoSave" 
		data-message-title="{{ trans('translate.create_notification') }}" data-message-error="{{ trans('translate.validation_error_messages') }}" data-message-success="{{ trans('translate.message_was_sent') }}">
			<i class="fa fa-share"></i> {{ trans('translate.send') }}
		</button>
	</div>
	
{{ Form::close() }}