@section('content')

	<div class="login">
		<header>
			<h1 class="text-center">{{ trans('translate.app_name') }}</h1>
		</header>

		<div class="authForm">
			<h3 class="text-center">{{ trans('translate.forgot_password') }}</h3>
					
			{{ Form::open(array('url' => 'reset', 'role' => 'form', 'id' => 'signinForm', 'class' => 'validateJSForm form-signin')) }}
			
				<div class="form-group">
					<label for="sendEmail" class="sr-only">{{ trans('translate.email') }}</label>
					<input type="email" id="sendEmail" name="sendEmail" class="form-control required autofocus" autocomplete="off" required autofocus
					placeholder="{{ trans('translate.email') }}" value="{{ Input::old('sendEmail') }}">
					
					<?php echo $errors->first('sendEmail', '<p class="error">:messages</p>');?>
				</div>	
				
				<div class="form-group">
					<button class="btn solso-pdf btn-block" type="submit">
						<i class="fa fa-share"></i> {{ trans('translate.send_password') }}
					</button>
				</div>
				
				<div class="form-group">
					<a href="{{ URL::to('login') }}"> {{ trans('translate.log_in') }}</a>
					<a href="{{ URL::to('create-account') }}" class="pull-right"> {{ trans('translate.sign_in') }}</a>
				</div>					
				
			{{ Form::close() }}					
				
		</div>
	</div>

@stop	