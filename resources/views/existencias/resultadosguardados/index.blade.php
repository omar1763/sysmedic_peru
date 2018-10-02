@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.resultadosguardados.title')</h3>
   
      {!! Form::open(['method' => 'get', 'route' => ['admin.resultadosguardados.index']]) !!}
       <div class="row">
         <div class="col-md-4">
            {!! Form::label('fecha', 'Fecha Inicio', ['class' => 'control-label']) !!}
            {!! Form::date('fecha', old('fechanac'), ['id'=>'fecha','class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
            <p class="help-block"></p>
            @if($errors->has('fecha'))
            <p class="help-block">
                {{ $errors->first('fecha') }}
            </p>
            @endif
        </div>
        <div class="col-md-4">
            {!! Form::label('fecha2', 'Fecha Fin', ['class' => 'control-label']) !!}
            {!! Form::date('fecha2', old('fecha2'), ['id'=>'fecha2','class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
            <p class="help-block"></p>
            @if($errors->has('fecha2'))
            <p class="help-block">
                {{ $errors->first('fecha2') }}
            </p>
            @endif
        </div>
        <div class="col-md-4">
            {!! Form::submit(trans('global.app_search'), array('class' => 'btn btn-info')) !!}
            {!! Form::close() !!}

        </div>

    </div>
  
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($servicios) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>@lang('global.resultados.fields.detalle')</th>
                        <th>Paciente</th>
                        <th>Origen</th>
                        <th>@lang('global.resultados.fields.fecha')</th>
                    
                        <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($servicios) > 0)
                        @foreach ($servicios as $serv)
                            <tr data-entry-id="{{ $serv->id }}">
                                <td></td>

                                <td>{{ $serv->detalleservicio }}</td>
                                <td>{{ $serv->nombres }},{{ $serv->apellidos }}</td>
                                <td>{{ $serv->name }},{{ $serv->ape }}</td>
                                <td>{{ $serv->created_at }}</td>

                                <td>

                                     @if ($serv->status_redactar_resultados==1)
                                     <a href="{{ route('resultados',['id'=>$serv->id]) }}" target="_blank" class="btn btn-xs btn-success">@lang('global.app_view')</a>
                                     @else
                                    <a href="{{ route('admin.resultados.create',['id'=>$serv->id]) }}" class="btn btn-xs btn-info">@lang('global.app_create_resultado')</a>
                                     @endif
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

