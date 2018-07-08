@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.ingresos.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.ingresos.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('producto', 'Producto*', ['class' => 'control-label']) !!}
                    {!! Form::select('producto', $producto, old('producto'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('producto'))
                        <p class="help-block">
                            {{ $errors->first('producto') }}
                        </p>
                    @endif
                </div>
            </div>

              <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('cantidad', 'Cantidad', ['class' => 'control-label']) !!}
                    {!! Form::number('cantidad', old('cantidad'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('cantidad'))
                        <p class="help-block">
                            {{ $errors->first('cantidad') }}
                        </p>
                    @endif
                </div>
            </div>
                <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('fechaingreso', 'Fecha de Ingreso', ['class' => 'control-label']) !!}
                    {!! Form::date('fechaingreso', old('fechaingreso'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('fechaingreso'))
                        <p class="help-block">
                            {{ $errors->first('fechaingreso') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

