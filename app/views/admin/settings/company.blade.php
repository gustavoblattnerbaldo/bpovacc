<div class="col-md-12 ">
	<h3>{{ trans('translate.company') }}</h3>
</div>		

{{ Form::open(array('id' => 'company', 'role' => 'form', 'class' => 'solsoForm')) }}
	
	<div class="col-md-6 col-lg-4">
		<div class="form-group">
			<label for="name">{{ trans('translate.name') }}</label>
			<input type="text" name="name" class="form-control required" autocomplete="off" value="{{ Input::old('name') ? Input::old('name') : $company->name }}">
			
			<?php echo $errors->first('name', '<p class="error">:messages</p>');?>
		</div>		

		<div class="form-group">
			<label for="country">{{ trans('translate.country') }}</label>
			<input type="text" name="country" class="form-control required" autocomplete="off" value="{{ Input::old('country') ? Input::old('country') : $company->country }}">
			
			<?php echo $errors->first('country', '<p class="error">:messages</p>');?>
		</div>		

		<div class="form-group">
			<label for="state">{{ trans('translate.region') }}</label>
			<input type="text" name="state" class="form-control required" autocomplete="off" value="{{ Input::old('state') ? Input::old('state') : $company->state }}">
			
			<?php echo $errors->first('state', '<p class="error">:messages</p>');?>
		</div>			
		
		<div class="form-group">
			<label for="city">{{ trans('translate.city') }}</label>
			<input type="text" name="city" class="form-control required" autocomplete="off" value="{{ Input::old('city') ? Input::old('city') : $company->city }}">
			
			<?php echo $errors->first('city', '<p class="error">:messages</p>');?>
		</div>

		<div class="form-group">
			<label for="zip">{{ trans('translate.zip_code') }}</label>
			<input type="text" name="zip" class="form-control required" autocomplete="off" value="{{ Input::old('zip') ? Input::old('zip') : $company->zip }}">
			
			<?php echo $errors->first('zip', '<p class="error">:messages</p>');?>
		</div>
	</div>
	
	<div class="col-md-6 col-lg-4">		
		<div class="form-group">
			<label for="address">{{ trans('translate.address') }}</label>
			<input type="text" name="address" class="form-control required" autocomplete="off" value="{{ Input::old('address') ? Input::old('address') : $company->address }}">
			
			<?php echo $errors->first('address', '<p class="error">:messages</p>');?>
		</div>	
		
		<div class="form-group">
			<label for="contact">{{ trans('translate.contact') }}</label>
			<input type="text" name="contact" class="form-control required" autocomplete="off" value="{{ Input::old('contact') ? Input::old('contact') : $company->contact }}">
			
			<?php echo $errors->first('contact', '<p class="error">:messages</p>');?>
		</div>				
		
		<div class="form-group">
			<label for="phone">{{ trans('translate.phone') }}</label>
			<input type="text" name="phone" class="form-control required" autocomplete="off" value="{{ Input::old('phone') ? Input::old('phone') : $company->phone }}">
			
			<?php echo $errors->first('phone', '<p class="error">:messages</p>');?>
		</div>	

		<div class="form-group">
			<label for="email">{{ trans('translate.email') }}</label>
			<input type="email" name="email" class="form-control required" autocomplete="off" value="{{ Input::old('email') ? Input::old('email') : $company->email }}">
			
			<?php echo $errors->first('email', '<p class="error">:messages</p>');?>
		</div>		

		<div class="form-group">
			<label for="website">{{ trans('translate.website') }}</label>
			<span class="pull-right">http://www.domain.com</span>
			<input type="url" name="website" class="form-control" autocomplete="off" value="{{ Input::old('website') ? Input::old('website') : $company->website }}">
			
			<?php echo $errors->first('website', '<p class="error">:messages</p>');?>
		</div>			
	</div>
	<div class="clearfix"></div>
	
	<div class="col-md-12 col-lg-8">
		<div class="form-group">
			<label for="description">{{ trans('translate.description') }}</label>
			<textarea name="description" class="form-control" rows="7" autocomplete="off">{{ Input::old('description') ? Input::old('description') : $company->description }}</textarea>
		</div>	
	</div>
	
	<div class="form-group col-md-12">
		<input type="hidden" name="solsoStatus" value="{{ isset($status) ? $status : 'false'; }}">
		<button type="submit" class="btn btn-success solsoAjax" 
			data-href="{{ URL::to('admin/company') }}" data-form="company" data-method="post" data-return="tabCompany" 
			data-message-title="{{ trans('translate.update_notification') }}" data-message-error="{{ trans('translate.validation_error_messages') }}" data-message-success="{{ trans('translate.data_was_updated') }}">
			<i class="fa fa-save"></i> {{ trans('translate.save') }}
		</button>	
	</div>
	
{{ Form::close() }}