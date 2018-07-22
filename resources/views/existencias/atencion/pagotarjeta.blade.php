                <div class="col-xs-12 form-group">
                    {!! Form::label('acuenta', 'Datos de Tarjeta*', ['class' => 'control-label']) !!}
                    {!! Form::text('acuenta', old('acuenta'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('acuenta'))
                        <p class="help-block">
                            {{ $errors->first('acuenta') }}
                        </p>
                    @endif
                </div>

