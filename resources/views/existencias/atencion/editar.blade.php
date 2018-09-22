@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.atencion.title')</h3>
    
    {!! Form::model($atencion, ['method' => 'PUT', 'route' => ['admin.atencion.update', $atencion->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
           <div class="row">
                <div class="col-md-6">
                    {!! Form::label('pacientes', 'Pacientes*', ['class' => 'control-label']) !!}
                    {!! Form::select('pacientes', $pacientes, old('pacientes'), ['id'=>'paciente','class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('pacientes'))
                        <p class="help-block">
                            {{ $errors->first('pacientes') }}
                        </p>
                    @endif
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <a id="btn_add" onclick="addCiente()" style="margin-top:25px;" class="btn btn-danger">
                      <i class="glyphicon glyphicon-plus"></i>
                    </a>
                  </div>
                </div>


            </div>

          <div class="row">
             <div class="col" id="pac">

             </div>
          </div>
            
           <div class="row">

         <div class="col-md-9">
                    {!! Form::label('servicio', 'Servicios', ['class' => 'control-label']) !!}
                
                    <select name="servicio[]" class="form-control select2"  multiple="multiple">
                        @foreach($servicio as $data)
                        @if(in_array($data->id, $servicioIds))
                        <option value="{{ $data->id }}" selected="true">{{ $data->detalle }}</option>
                        @else
                        <option value="{{ $data->id }}">{{ $data->detalle }}</option>
                        @endif 
                        @endforeach
                    </select>
                    <p class="help-block"></p>
                    @if($errors->has('servicio'))
                        <p class="help-block">
                            {{ $errors->first('servicio') }}
                        </p>
                    @endif
                </div>

            <div class="col-md-3">
              {!! Form::label('precioserv', 'Monto Servicios', ['class' => 'control-label']) !!}
              {!! Form::text('precioserv', old('precioserv'), ['class' => 'form-control', 'placeholder' => '']) !!}
              <p class="help-block"></p>
              @if($errors->has('precioserv'))
              <p class="help-block">
                {{ $errors->first('precioserv') }}
              </p>
              @endif
            </div>
          </div>

          <div class="row">
            <div class="col-md-9">
              {!! Form::label('analises', 'Analisis de Laboratorio*', ['class' => 'control-label']) !!}
              {!! Form::select('analises[]', $analises, old('analises'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'onchange'=>"ajaxLoadSelect2('/existencias/atencion/cardainput2', 'analises',$(this).val())"]) !!}
              <p class="help-block"></p>
              @if($errors->has('analises'))
              <p class="help-block">
                {{ $errors->first('analises') }}
              </p>
              @endif
            </div>

             <div class="col-md-3">

              {!! Form::label('preciopublico', 'Monto Analisis', ['class' => 'control-label']) !!}
              {!! Form::text('preciopublico', old('preciopublico'), ['class' => 'form-control', 'placeholder' => '']) !!}
              <p class="help-block"></p>
              @if($errors->has('preciopublico'))
              <p class="help-block">
                {{ $errors->first('preciopublico') }}
              </p>
              @endif
          </div>
        </div>

          <div class="row"> 
           <div class="col-md-9">
            {!! Form::label('paquetes', 'Paquetes*', ['class' => 'control-label']) !!}
            {!! Form::select('paquetes[]', $paquetes, old('paquetes'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'onchange'=>"ajaxLoadSelect3('/existencias/atencion/cardainput3', 'analises',$(this).val())"]) !!}
            <p class="help-block"></p>
            @if($errors->has('paquetes'))
            <p class="help-block">
              {{ $errors->first('paquetes') }}
            </p>
            @endif
          </div>

          <div class="col-md-3">

            {!! Form::label('costo', 'Monto Paquetes', ['class' => 'control-label']) !!}
            {!! Form::text('costo', old('costo'), ['class' => 'form-control', 'placeholder' => '']) !!}
            <p class="help-block"></p>
            @if($errors->has('costo'))
            <p class="help-block">
              {{ $errors->first('costo') }}
            </p>
            @endif
          </div>

        </div>
          <div class="row">

               <div class="col-md-9">
               </div>

              <div class="col-md-3"">

              {!! Form::label('preciototal', 'Monto Total', ['id'=>'MiTotal','class' => 'control-label']) !!}
              {!! Form::text('preciototal', old('preciototal'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
              <p class="help-block"></p>
              @if($errors->has('preciototal'))
              <p class="help-block">
                {{ $errors->first('preciototal') }}
              </p>
              @endif
            </div>
            

          </div>



        <div class="row">
          
          <div class="col-md-6 id="ser">

         </div>
        </div>

        <div class="row">
          
          <div class="col-md-4">
            <div id="origen_paciente" class="form-group error-status">
              {!! Form::label("origen_paciente","* Origen del Paciente",["class"=>""]) !!}
              <div class="input-icon">
                <div class="input-icon">
                  <i class="icon-eye  font-red"></i>
                  
                  {!! Form::select('origen_paciente', ['0' => 'Seleccionar Origen del Paciente','PER' => 'Personal', 'PRO' => 'Profesional'], null, ['id'=>'tipoO', 'class'=>'form-control select2']) !!}
                </div>

              </div>
            </div> 
          </div>

          <div class="col-md-4">   
            {!! Form::label('profesional', 'Prof. de Apoyo*', ['class' => 'control-label']) !!}
            {!! Form::select('profesional', $profesional, old('profesional'), ['class' => 'form-control select2', 'required' => 'required']) !!}
            <p class="help-block"></p>
            @if($errors->has('profesional'))
            <p class="help-block">
              {{ $errors->first('profesional') }}
            </p>
            @endif

          </div>

          <div class="col-md-4">   
            {!! Form::label('personal', 'Personal*', ['class' => 'control-label']) !!}
            {!! Form::select('personal', $personal, old('personal'), ['class' => 'form-control select2', 'required' => 'required']) !!}
            <p class="help-block"></p>
            @if($errors->has('personal'))
            <p class="help-block">
              {{ $errors->first('personal') }}
            </p>
            @endif
          </div>

        </div>

        <div class="row">
         <div class="col-md-6">
          {!! Form::label("acuenta","*A cuenta",["class"=>""]) !!}
          <div class="input-icon">
            <div class="input-icon">
              <i class="icon-eye  font-red"></i>

              {!! Form::select('acuenta', ['0' => 'Seleccione una Opciòn','EF' => 'Pago en Efectivo', 'TJ' => 'Pago con Tarjeta'], null, ['id'=>'pago', 'class'=>'form-control select2']) !!}
            </div>

          </div>
        </div>

        <div class="col-md-6">
          {!! Form::label('costoa', 'Monto a Abonar', ['class' => 'control-label']) !!}
          {!! Form::text('costoa', old('costoa'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
          <p class="help-block"></p>
          @if($errors->has('costoa'))
          <p class="help-block">
            {{ $errors->first('costoa') }}
          </p>
          @endif
        </div>
      </div>

        <div class="row">
          <div class="col-md-6">
            {!! Form::label('tarjeta', 'Datos de Tarjeta', ['class' => 'control-label']) !!}
            {!! Form::text('tarjeta', old('tarjeta'), ['class' => 'form-control', 'placeholder' => '']) !!}
            <p class="help-block"></p>
            @if($errors->has('tarjeta'))
            <p class="help-block">
              {{ $errors->first('tarjeta') }}
            </p>
            @endif
          </div>
          <div class="col-md-6">
            {!! Form::label('observaciones', 'Observaciones', ['class' => 'control-label']) !!}
            {!! Form::text('observaciones', old('observaciones'), ['class' => 'form-control', 'placeholder' => '']) !!}
            <p class="help-block"></p>
            @if($errors->has('observaciones'))
            <p class="help-block">
              {{ $errors->first('observaciones') }}
            </p>
            @endif
          </div>
        </div>

        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

