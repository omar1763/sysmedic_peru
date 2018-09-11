 <div class="col-xs-12 form-group">
	{!! Form::label('analisis', 'Laboratorios', ['class' => 'control-label']) !!}
	{!! Form::select('analisis', $analisis, old('analisis'), ['class' => 'form-control select2', 'required' => 'required']) !!}
	<p class="help-block"></p>
	@if($errors->has('analisis'))
	<p class="help-block">
		{{ $errors->first('analisis') }}
	</p>
	@endif
</div>