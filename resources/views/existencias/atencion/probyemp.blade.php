      
        <div class="col-xs-12 form-group">
            {!! Form::label('profesional', 'Prof. de Apoyo*', ['class' => 'control-label']) !!}
            {!! Form::select('profesional', $profesional, old('profesional'), ['class' => 'form-control select2', 'required' => 'required']) !!}
            <p class="help-block"></p>
            @if($errors->has('profesional'))
                <p class="help-block">
                    {{ $errors->first('profesional') }}
                </p>
            @endif
        </div>