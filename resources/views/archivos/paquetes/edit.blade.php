@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.paquetes.title')</h3>
    
    {!! Form::model($paquetes, ['method' => 'PUT', 'route' => ['admin.paquetes.update', $paquetes->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
          <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Name*', ['class' => 'control-label']) !!}
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
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('analisis', 'Analisis', ['class' => 'control-label']) !!}
                
                    <select name="analisis[]" class="form-control select2"  multiple="multiple">
                        @foreach($analisis as $data)
                        @if(in_array($data->id, $analisisIds))
                        <option value="{{ $data->id }}" selected="true">{{ $data->name }}</option>
                        @else
                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                        @endif 
                        @endforeach
                    </select>
                    <p class="help-block"></p>
                    @if($errors->has('analisis'))
                        <p class="help-block">
                            {{ $errors->first('analisis') }}
                        </p>
                    @endif
                </div>
            </div>
             <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('costo', 'Costo*', ['class' => 'control-label']) !!}
                    {!! Form::text('costo', old('costo'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('costo'))
                        <p class="help-block">
                            {{ $errors->first('costo') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

