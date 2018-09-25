                    {!! Form::label('distritos', 'Distritos', ['class' => 'control-label']) !!}
                    {!! Form::select('distritos', $distritos, old('distritos'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('distritos'))
                    <p class="help-block">
                    	{{ $errors->first('distritos') }}
                    </p>
                    @endif
