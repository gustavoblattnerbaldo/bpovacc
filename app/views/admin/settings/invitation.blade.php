<div class="col-md-12 col-lg-8">
	<h3>{{ trans('translate.invitation') }}</h3>
	
	{{ Form::open(array('role' => 'form')) }}

		<div class="form-group">
			<label for="title">{{ trans('translate.title') }}</label>
			<input type="text" name="title" class="form-control required" autocomplete="off" value="{{ isset($invitation->title) ? $invitation->title : (isset($inputs['title']) ? $inputs['title'] : '') }}">
			
			<?php echo $errors->first('title', '<p class="error">:messages</p>');?>
		</div>
		
		<div class="form-group">
			<label for="content">{{ trans('translate.content') }}</label>
			<textarea name="content" class="form-control required solsoEditor" rows="7" autocomplete="off">{{ isset($invitation->content) ? $invitation->content : (isset($inputs['content']) ? $inputs['content'] : '') }}</textarea>
			
			<?php echo $errors->first('content', '<p class="error">:messages</p>');?>
		</div>	
		
		<div class="form-group">
			<input type="hidden" name="solsoStatus" value="{{ isset($alert) ? $alert : 'false'; }}">
					
			@if ($invitation)
				<button type="submit" class="btn btn-success solsoAjax" 
					data-href="{{ URL::to('invitation/' . $invitation->id) }}" data-method="put" data-return="tabInvitation" 
					data-message-title="{{ trans('translate.update_notification') }}" data-message-error="{{ trans('translate.validation_error_messages') }}" data-message-success="{{ trans('translate.data_was_updated') }}">
					<i class="fa fa-save"></i> {{ trans('translate.save') }}
				</button>
			@else	
				<button type="submit" class="btn btn-success solsoAjax" 
					data-href="{{ URL::to('invitation') }}" data-method="post" data-return="tabInvitation" 
					data-message-title="{{ trans('translate.create_notification') }}" data-message-error="{{ trans('translate.validation_error_messages') }}" data-message-success="{{ trans('translate.data_was_saved') }}">
					<i class="fa fa-save"></i> {{ trans('translate.save') }}
				</button>
			@endif			
			
		</div>			
		
	{{ Form::close() }}
	
</div>