      
        <div class="col-xs-12 form-group">
            {!! Form::label('personal', 'Personal*', ['class' => 'control-label']) !!}
            {!! Form::select('personal', $personal, old('personal'), ['class' => 'form-control select2', 'required' => 'required']) !!}
            <p class="help-block"></p>
            @if($errors->has('personal'))
                <p class="help-block">
                    {{ $errors->first('personal') }}
                </p>
            @endif
        </div>