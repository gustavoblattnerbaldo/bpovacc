<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
</head>

<body>
	<h2>{{ trans('translate.new_ticket') }}</h2>

	<table>
		<tr>
			<td>{{ trans('translate.user') }}</td>
			<td>{{ $staff }}</td>
		</tr>
		
		<tr>
			<td>{{ trans('translate.password') }}</td>
			<td>{{ $password }}</td>
		</tr>            
	</table>
</body>
</html>