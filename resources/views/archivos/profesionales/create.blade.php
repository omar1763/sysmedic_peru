@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.profesionales.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.profesionales.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Nombres*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('apellidos', 'Apellidos*', ['class' => 'control-label']) !!}
                    {!! Form::text('apellidos', old('apellidos'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('apellidos'))
                        <p class="help-block">
                            {{ $errors->first('apellidos') }}
                        </p>
                    @endif
                </div>
            </div>
             <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('cmp', 'CMP*', ['class' => 'control-label']) !!}
                    {!! Form::text('cmp', old('cmp'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('cmp'))
                        <p class="help-block">
                            {{ $errors->first('cmp') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('centro', 'Centros Mèdicos*', ['class' => 'control-label']) !!}
                    {!! Form::select('centro', $centro, old('centro'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('centro'))
                        <p class="help-block">
                            {{ $errors->first('centro') }}
                        </p>
                    @endif
                </div>
            </div>
              <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('especialidad', 'Especialidades*', ['class' => 'control-label']) !!}
                    {!! Form::select('especialidad', $especialidad, old('especialidad'), ['class' => 'form-control select2','required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('especialidad'))
                        <p class="help-block">
                            {{ $errors->first('especialidad') }}
                        </p>
                    @endif
                </div>
            </div>
              <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('nacimiento', 'Nacimiento', ['class' => 'control-label']) !!}
                    {!! Form::date('nacimiento', old('nacimiento'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('nacimiento'))
                        <p class="help-block">
                            {{ $errors->first('nacimiento') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

