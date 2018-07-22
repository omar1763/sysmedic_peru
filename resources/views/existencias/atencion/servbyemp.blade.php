      
        <div class="col-xs-12 form-group">
            {!! Form::label('servicio', 'Servicio*', ['class' => 'control-label']) !!}
            {!! Form::select('servicio', $servicio, old('servicio'), ['class' => 'form-control select2', 'required' => 'required']) !!}
            <p class="help-block"></p>
            @if($errors->has('servicio'))
                <p class="help-block">
                    {{ $errors->first('servicio') }}
                </p>
            @endif
        </div>