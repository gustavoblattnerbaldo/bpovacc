<div class="modal fade" id="solsoBanAccount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">{{ trans('translate.ban_account') }}</h4>
        </div>

        <div class="modal-body">
            <p>{{ trans('translate.ban_this_account') }}</p>
            <p>{{ trans('translate.want_to_proceed') }}<p>
        </div>

        <div class="modal-footer">

			{{ Form::open(array('id' => 'solsoFormDelete')) }}
				
				<button type="button" class="btn btn-primary" 
				data-dismiss="modal">
					{{ trans('translate.no') }}
				</button>
				
				<button class="btn btn-danger solsoDelete" 
				data-message-title="{{ trans('translate.update_notification') }}" data-message-success="{{ trans('translate.data_was_updated') }}">
					{{ trans('translate.yes') }}
				</button>
					
			{{ Form::close() }}									

        </div>
    </div>
</div>
</div>
