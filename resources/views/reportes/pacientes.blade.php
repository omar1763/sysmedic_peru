  <div class="col-xs-8 form-group">
                    {!! Form::label('pacientes', 'Pacientes', ['class' => 'control-label']) !!}
                    {!! Form::select('pacientes', $pacientes, old('pacientes'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('pacientes'))
                        <p class="help-block">
                            {{ $errors->first('pacientes') }}
                        </p>
                    @endif
                </div>