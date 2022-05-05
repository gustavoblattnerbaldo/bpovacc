<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="{{ url('public/css/bootstrap.min.css') }}">
</head>

<body>
	<h2>{{ trans('translate.password_was_reset') }}</h2>
	<h3>{{ trans('translate.login_with_credentials') }}</h3>

	<table class="table">
		<tr>
			<td>{{ trans('translate.user') }}:</td>
			<td>{{ $user }}</td>
		</tr>
		
		<tr>
			<td>{{ trans('translate.password') }}:</td>
			<td>{{ $password }}</td>
		</tr>			
	</table>
</body>
</html>