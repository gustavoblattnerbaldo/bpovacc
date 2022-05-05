<div class="col-md-12">
	<h1>
		{{ $client->name }}
	</h1>	
	
	<table class="table table-striped">
	<caption>{{ trans('translate.client_details') }}</caption>
	<tbody>
		<tr>
			<td class="col-md-4">{{ trans('translate.email') }}</td>
			<td class="col-md-8">{{ $client->email }}</td>
		</tr>	
	</tbody>
	</table>
</div>