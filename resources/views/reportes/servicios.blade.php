        <div class="col-xs-12 form-group">
	{!! Form::label('servicios', 'Servicios', ['class' => 'control-label']) !!}
	{!! Form::select('servicios', $servicios, old('servicios'), ['class' => 'form-control select2', 'required' => 'required']) !!}
	<p class="help-block"></p>
	@if($errors->has('servicios'))
	<p class="help-block">
		{{ $errors->first('servicios') }}
	</p>
	@endif
</div>