@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.gastos.title')</h3>
    
    {!! Form::model($gastos, ['method' => 'PUT', 'route' => ['admin.gastos.update', $gastos->id]]) !!}

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
                    {!! Form::label('concepto', 'Concepto*', ['class' => 'control-label']) !!}
                    {!! Form::text('concepto', old('concepto'), ['class' => 'form-control', 'placeholder' => '', 'required' => 'false']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('concepto'))
                        <p class="help-block">
                            {{ $errors->first('concepto') }}
                        </p>
                    @endif
                </div>
            </div>
        
             <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('monto', 'Monto*', ['class' => 'control-label']) !!}
                    {!! Form::text('monto', old('monto'), ['class' => 'form-control', 'placeholder' => '', 'required' => 'false']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('monto'))
                        <p class="help-block">
                            {{ $errors->first('monto') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

