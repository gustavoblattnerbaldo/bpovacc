<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
<div class="container-fluid">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>

		<div class="brand">
			<a class="navbar-brand" href="<?php echo URL::to('');?>"><span>{{ trans('translate.app_name') }}</span></a>
		</div>		
	</div>

	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
			<li>
				<a href="<?php echo URL::to('login');?>">
					<i class="fa fa-lock"></i> {{ trans('translate.log_in') }}
				</a>
			</li>			
			
			<li>
				<a href="<?php echo URL::to('create-account');?>">
					<i class="fa fa-sign-in"></i> {{ trans('translate.sign_in') }}
				</a>
			</li>			
			
			<li>
				<a href="{{ URL::to('forgot-password') }}">
					<i class="fa fa-unlock-alt"></i> {{ trans('translate.forgot_password') }}
				</a>
			</li>

			<li>
				<a href="<?php echo URL::to('guest-ticket');?>">
					<i class="fa fa-plus"></i> {{ trans('translate.guest_ticket') }}
				</a>
			</li>			
		</ul>
	</div>
</div>
</nav>