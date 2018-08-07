@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.analisis.title')</h3>
    
    {!! Form::model($analisis, ['method' => 'PUT', 'route' => ['admin.analisis.update', $analisis->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
           <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Nombre*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
           <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('laboratorio', 'Laboratorio', ['class' => 'control-label']) !!}
                    {!! Form::select('laboratorio', $laboratorio, old('laboratorio'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('laboratorio'))
                        <p class="help-block">
                            {{ $errors->first('laboratorio') }}
                        </p>
                    @endif
                </div>
            </div>
        
             <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('preciopublico', 'Precio al Pùblico', ['class' => 'control-label']) !!}
                    {!! Form::text('preciopublico', old('preciopublico'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('preciopublico'))
                        <p class="help-block">
                            {{ $errors->first('preciopublico') }}
                        </p>
                    @endif
                </div>
            </div>

             <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('porcentaje', 'Porcentaje', ['class' => 'control-label']) !!}
                    {!! Form::text('porcentaje', old('porcentaje'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('porcentaje'))
                        <p class="help-block">
                            {{ $errors->first('porcentaje') }}
                        </p>
                    @endif
                </div>
            </div>
          
             <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('costlab', 'Costo de Laboratorio', ['class' => 'control-label']) !!}
                    {!! Form::text('costlab', old('costlab'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('costlab'))
                        <p class="help-block">
                            {{ $errors->first('costlab') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

