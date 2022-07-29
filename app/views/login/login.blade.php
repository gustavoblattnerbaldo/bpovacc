@section('content')

	<div class="login">
		<div class="authForm">
		<header class="img-logo">
				<img src="{{URL::asset('public/img/logo_white.png')}}" alt="Logo">
		</header>
				
			{{ Form::open(array('url' => 'auth', 'role' => 'form', 'class' => 'validateJSForm form-signin')) }}
			
				<div class="form-group">
					<label for="email" class="sr-only">{{ trans('translate.email') }}</label>
					<input type="email" name="email" class="form-control autofocus required" 
					autocomplete="off" autofocus placeholder="{{ trans('translate.email') }}" value="{{ Input::old('email') }}">
					
					<?php echo $errors->first('email', '<p class="error">:messages</p>');?>
				</div>
				
				<div class="form-group">
					<label for="password" class="sr-only">{{ trans('translate.password') }}</label>
					<input type="password" name="password" class="form-control required" 
					autocomplete="off" placeholder="{{ trans('translate.password') }}"
					data-parsley-minlength="6">
					
					<?php echo $errors->first('password', '<p class="error">:messages</p>');?>
				</div>

				<div class="form-group">
					<!-- <a href="{{ URL::to('create-account') }}"> {{ trans('translate.sign_in') }}</a> -->
					<a href="{{ URL::to('forgot-password') }}"> {{ trans('translate.forgot_password') }}</a>
				</div>

				<div class="form-group">
					<button class="btn solso-email btn-block" type="submit">
						<i class="fa fa-sign-in"></i> {{ trans('translate.log_in') }}
					</button>
				</div>
				

				
					<!-- <a href="<?php echo URL::to('guest-ticket');?>" class="textDec"> 
						<button class="btn solso-email btn-block" type="button"> 
						<i class="fa fa-plus"></i> {{ trans('translate.guest_ticket') }}
						</button>
					</a> -->

			{{ Form::close() }}	
		</div>
	</div>

@stop	