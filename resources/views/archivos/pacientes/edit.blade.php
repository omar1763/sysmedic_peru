@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.pacientes.title')</h3>
    
    {!! Form::model($pacientes, ['method' => 'PUT', 'route' => ['pacientes.update', $pacientes->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
          <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('dni', 'DNI', ['class' => 'control-label']) !!}
                    {!! Form::text('dni', old('dni'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('dni'))
                        <p class="help-block">
                            {{ $errors->first('dni') }}
                        </p>
                    @endif
                </div>
            
                <div class="col-xs-6 form-group">
                    {!! Form::label('nombres', 'Nombres', ['class' => 'control-label']) !!}
                    {!! Form::text('nombres', old('nombres'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('nombres'))
                        <p class="help-block">
                            {{ $errors->first('nombres') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('apellidos', 'Apellidos', ['class' => 'control-label']) !!}
                    {!! Form::text('apellidos', old('apellidos'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('apellidos'))
                        <p class="help-block">
                            {{ $errors->first('apellidos') }}
                        </p>
                    @endif
                </div>
           
                <div class="col-xs-6 form-group">
                    {!! Form::label('direccion', 'Direcciòn', ['class' => 'control-label']) !!}
                    {!! Form::text('direccion', old('direccion'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('direccion'))
                        <p class="help-block">
                            {{ $errors->first('direccion') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('telefono', 'Telefono', ['class' => 'control-label']) !!}
                    {!! Form::text('telefono', old('telefono'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('telefono'))
                        <p class="help-block">
                            {{ $errors->first('telefono') }}
                        </p>
                    @endif
                </div>
           
                <div class="col-xs-6 form-group">
                    {!! Form::label('provincia', 'Provincia*', ['class' => 'control-label']) !!}
                    {!! Form::select('provincia', $provincia, old('provincia'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('provincia'))
                        <p class="help-block">
                            {{ $errors->first('provincia') }}
                        </p>
                    @endif
                </div>
            </div>

             <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('distrito', 'Distrito*', ['class' => 'control-label']) !!}
                    {!! Form::select('distrito', $distrito, old('distrito'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('distrito'))
                        <p class="help-block">
                            {{ $errors->first('distrito') }}
                        </p>
                    @endif
                </div>
            
                <div class="col-xs-6 form-group">
                    {!! Form::label('edocivil', 'Estado Civil*', ['class' => 'control-label']) !!}
                    {!! Form::select('edocivil', $edocivil, old('edocivil'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('edocivil'))
                        <p class="help-block">
                            {{ $errors->first('edocivil') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('gradoinstruccion', 'Grado de Instrucciòn*', ['class' => 'control-label']) !!}
                    {!! Form::select('gradoinstruccion', $gradoinstruccion, old('gradoinstruccion'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('gradoinstruccion'))
                        <p class="help-block">
                            {{ $errors->first('gradoinstruccion') }}
                        </p>
                    @endif
                </div>
            
                <div class="col-xs-6 form-group">
                    {!! Form::label('ocupacion', 'Ocupaciòn', ['class' => 'control-label']) !!}
                    {!! Form::text('ocupacion', old('ocupacion'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('ocupacion'))
                        <p class="help-block">
                            {{ $errors->first('ocupacion') }}
                        </p>
                    @endif
                </div>
            </div>
                <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('fechanac', 'Fecha de Nacimiento', ['class' => 'control-label']) !!}
                    {!! Form::date('fechanac', old('fechanac'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('fechanac'))
                        <p class="help-block">
                            {{ $errors->first('fechanac') }}
                        </p>
                    @endif
                </div>
            </div>
            
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

