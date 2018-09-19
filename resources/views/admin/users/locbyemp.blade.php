  <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('locales', 'Local', ['class' => 'control-label']) !!}
                    {!! Form::select('locales', $locales, old('locales'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('locales'))
                        <p class="help-block">
                            {{ $errors->first('locales') }}
                        </p>
                    @endif
                </div>
            </div>