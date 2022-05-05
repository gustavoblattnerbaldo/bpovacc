@section('content')

	<div class="login">
		<header>
			<h1 class="text-center">{{ trans('translate.app_name') }}</h1>
		</header>

		<div class="authForm">
			<h3 class="text-center">{{ trans('translate.log_in_to_your_account') }}</h3>
					
			{{ Form::open(array('url' => 'auth', 'role' => 'form', 'class' => 'validateJSForm form-signin')) }}
			
				<div class="form-group">
					<label for="email" class="sr-only">{{ trans('translate.email') }}</label>
					<input type="email" name="email" class="form-control required autofocus" 
					autocomplete="off" required autofocus placeholder="{{ trans('translate.email') }}" value="{{ Input::old('email') }}">
					
					<?php echo $errors->first('email', '<p class="error">:messages</p>');?>
				</div>
				
				<div class="form-group">
					<label for="password" class="sr-only">{{ trans('translate.password') }}</label>
					<input type="password" name="password" class="form-control required" 
					autocomplete="off" required placeholder="{{ trans('translate.password') }}"
					data-parsley-minlength="6">
					
					<?php echo $errors->first('password', '<p class="error">:messages</p>');?>
				</div>
				
				<div class="form-group">
					<button class="btn solso-email btn-block" type="submit">
						<i class="fa fa-sign-in"></i> {{ trans('translate.log_in') }}
					</button>
				</div>
				
				<div class="form-group">
					<a href="{{ URL::to('create-account') }}"> {{ trans('translate.sign_in') }}</a>
					<a href="{{ URL::to('forgot-password') }}" class="pull-right"> {{ trans('translate.forgot_password') }}</a>
				</div>
				
			{{ Form::close() }}	

		</div>
	</div>


@stop	