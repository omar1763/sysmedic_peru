@extends('layouts.app')

@section('content')
    <h3 class="page-title">Locales</h3>
    
    {!! Form::model($locales, ['method' => 'PUT', 'route' => ['admin.locales.update', $locales->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
        	  <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('empresas', 'Empresa', ['class' => 'control-label']) !!}
                    {!! Form::select('empresas', $empresas, old('empresas'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('empresas'))
                        <p class="help-block">
                            {{ $errors->first('empresas') }}
                        </p>
                    @endif
                </div>
            </div>
          <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('nombres', 'Nombre de Local*', ['class' => 'control-label']) !!}
                    {!! Form::text('nombres', old('nombres'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('nombres'))
                        <p class="help-block">
                            {{ $errors->first('nombres') }}
                        </p>
                    @endif
                </div>
            </div>
         
             
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

