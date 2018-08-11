      
        <div class="col-xs-12 form-group">
            {!! Form::label('servicio', 'Servicio*', ['class' => 'control-label']) !!}
            {!! Form::select('servicio[]', $servicio, old('servicio'), ['onchange'=>"ajaxLoadSelect('/existencias/atencion/cardainput', 'servicios',$(this).val())", 'id'=>'servicios','class' => 'form-control select2', 'multiple' => 'multiple']) !!}
            <p class="help-block"></p>
            @if($errors->has('servicio'))
                <p class="help-block">
                    {{ $errors->first('servicio') }}
                </p>
            @endif
        </div>

        <div class="row">
            
        <div class="col-md-6 id="ser">

        </div>
        </div>


  