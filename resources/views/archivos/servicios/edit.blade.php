@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.servicios.title')</h3>
    
    {!! Form::model($servicios, ['method' => 'PUT', 'route' => ['admin.servicios.update', $servicios->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
           <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('detalle', 'Detalle', ['class' => 'control-label']) !!}
                    {!! Form::text('detalle', old('detalle'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('detalle'))
                        <p class="help-block">
                            {{ $errors->first('detalle') }}
                        </p>
                    @endif
                </div>
            </div>
             <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('precio', 'Precio', ['class' => 'control-label']) !!}
                    {!! Form::text('precio', old('precio'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('precio'))
                        <p class="help-block">
                            {{ $errors->first('precio') }}
                        </p>
                    @endif
                </div>
            </div>
        
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

