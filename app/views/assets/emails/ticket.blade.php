<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
</head>

<body>
	<h2>{{ trans('translate.new_ticket') }}</h2>

	<table>
		<tr>
			<td>{{ trans('translate.title') }}</td>
			<td>{{ $title }}</td>
		</tr>
		
		<tr>
			<td>{{ trans('translate.content') }}</td>
			<td>{{ $content }}</td>
		</tr>            
	</table>
</body>
</html>