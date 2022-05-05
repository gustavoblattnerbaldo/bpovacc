@section('content')

	<div class="login">
		<header>
			<h1 class="text-center">{{ trans('translate.app_name') }}</h1>
		</header>

		<div class="authForm">
			<h3 class="text-center">{{ trans('translate.create_new_account') }}</h3>
					
			{{ Form::open(array('url' => 'signin', 'role' => 'form', 'class' => 'validateJSForm form-signin')) }}
			
				<div class="form-group">
					<label for="name" class="sr-only">{{ trans('translate.name') }}</label>
					<input type="text" name="name" class="form-control required" autocomplete="off" 
					autocomplete="off" required autofocus placeholder="{{ trans('translate.name') }}" value="{{ Input::old('name') }}">

					<?php echo $errors->first('name', '<p class="error">:messages</p>');?>
				</div>
			
				<div class="form-group">
					<label for="email" class="sr-only">{{ trans('translate.email') }}</label>
					<input type="email" id="email" name="email" class="form-control required" 
					autocomplete="off" placeholder="{{ trans('translate.email') }}">
					
					<?php echo $errors->first('email', '<p class="error">:messages</p>');?>
				</div>
				
				<div class="form-group">
					<label for="repeatEmail" class="sr-only">{{ trans('translate.repeat_email') }}</label>
					<input type="email" name="repeatEmail" class="form-control required" 
					autocomplete="off" placeholder="{{ trans('translate.repeat_email') }}" data-parsley-equalto="#email">
					
					<?php echo $errors->first('repeatEmail', '<p class="error">:messages</p>');?>
				</div>				
				
				<div class="form-group">
					<label for="password" class="sr-only">{{ trans('translate.password') }}</label>
					<input type="password" name="password" class="form-control required" 
					autocomplete="off" required placeholder="{{ trans('translate.password') }}"	data-parsley-minlength="6">
					
					<?php echo $errors->first('password', '<p class="error">:messages</p>');?>
				</div>
				
				<div class="form-group">
					<button class="btn solso-email btn-block" type="submit">
						<i class="fa fa-sign-in"></i> {{ trans('translate.sign_in') }}
					</button>
				</div>
				
				<div class="form-group">
					<a href="{{ URL::to('login') }}"> {{ trans('translate.log_in') }}</a>
					<a href="{{ URL::to('forgot-password') }}" class="pull-right"> {{ trans('translate.forgot_password') }}</a>
				</div>
				
			{{ Form::close() }}	

		</div>
	</div>

@stop	