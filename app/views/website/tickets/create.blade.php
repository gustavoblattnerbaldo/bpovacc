@section('content')

<div class="container">
	<div class="col-md-12">
	<h3>{{ trans('translate.guest_ticket') }}</h3>

	<div class="row">
		{{ Form::open(array('url' => 'website/send-ticket', 'role' => 'form', 'class' => 'validateJSForm top20')) }}

			<div class="form-group col-md-6">
				<label for="name">{{ trans('translate.name') }}</label>
				<input type="text" name="name" class="form-control required"
				autocomplete="off" required autofocus placeholder="{{ trans('translate.name') }}" value="{{ Input::old('name') }}">

				<?php echo $errors->first('name', '<p class="error">:messages</p>');?>
			</div>

			<div class="form-group col-md-6">
				<label for="email">{{ trans('translate.email') }}</label>
				<input type="email" id="email" name="email" class="form-control required"
				autocomplete="off" placeholder="{{ trans('translate.email') }}" value="{{ Input::old('email') }}">

				<?php echo $errors->first('email', '<p class="error">:messages</p>');?>
			</div>

			<div class="form-group col-md-6">
				<label for="title"> {{ trans('translate.title') }} </label>
				<input type="text" name="title" class="form-control required"
				autocomplete="off" placeholder="{{ trans('translate.title') }}" value="{{ Input::old('title') }}">

				<?php echo $errors->first('title', '<p class="error">:messages</p>');?>
			</div>

			<div class="form-group col-md-2">
				<label for="department_id">{{ trans('translate.department') }}</label>
				<select name="department_id" class="form-control required">
					<option value="" selected>{{ trans('translate.choose') }}</option>

					@foreach ($departments as $d)
						<option value="{{ $d->id }}">{{ trans('translate.' . Language::translateSlug($d->name, '_')) }}</option>
					@endforeach

				</select>

				<?php echo $errors->first('department_id', '<p class="error">:messages</p>');?>
			</div>

			<div class="form-group col-md-2">
				<label for="type_id">{{ trans('translate.ticket_type') }}</label>
				<select name="type_id" class="form-control required">
					<option value="" selected>{{ trans('translate.choose') }}</option>

					@foreach ($types as $t)
						<option value="{{ $t->id }}">{{ trans('translate.' . Language::translateSlug($t->name, '_')) }}</option>
					@endforeach

				</select>

				<?php echo $errors->first('type_id', '<p class="error">:messages</p>');?>
			</div>

			<div class="form-group col-md-2">
				<label for="priority_id">{{ trans('translate.priority') }}</label>
				<select name="priority_id" class="form-control required">
					<option value="" selected>{{ trans('translate.choose') }}</option>

					@foreach ($priorities as $p)
						<option value="{{ $p->id }}">{{ trans('translate.' . Language::translateSlug($p->name, '_')) }}</option>
					@endforeach

				</select>

				<?php echo $errors->first('priority_id', '<p class="error">:messages</p>');?>
			</div>

			<div class="form-group col-md-12">
				<label for="content"> {{ trans('translate.message') }} </label>
				<textarea name="content" class="form-control required solsoEditor" rows="7" autocomplete="off">{{ Input::old('content') }}</textarea>

				<?php echo $errors->first('content', '<p class="error">:messages</p>');?>
			</div>

			<div class="form-group col-md-12">
				<input type="hidden" name="guest" value="1">
				<button type="submit" class="btn btn-success">
					<i class="fa fa-share"></i> {{ trans('translate.send') }}
				</button>
			</div>

		{{ Form::close() }}

	</div>
	</div>
</div>

@stop