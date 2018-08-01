    
        <div class="col-xs-12 form-group">
            {!! Form::label('paquetes', 'Paquetes*', ['class' => 'control-label']) !!}
            {!! Form::select('paquetes', $paquetes, old('paquetes'), ['onchange'=>"ajaxLoadSelect('/existencias/atencion/cardainput', 'paquetes',$(this).val())",'class' => 'form-control select2', 'required' => 'required']) !!}
            <p class="help-block"></p>
            @if($errors->has('paquetes'))
                <p class="help-block">
                    {{ $errors->first('paquetes') }}
                </p>
            @endif
        </div>