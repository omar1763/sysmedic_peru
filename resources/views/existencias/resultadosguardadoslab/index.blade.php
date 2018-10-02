@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.resultadosguardadoslab.title')</h3>
   
      {!! Form::open(['method' => 'get', 'route' => ['admin.resultadosguardadoslab.index']]) !!}
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
            <table class="table table-bordered table-striped {{ count($laboratorios) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>@lang('global.resultadosguardadoslab.fields.detalle')</th>
                        <th>Paciente</th>
                        <th>Origen</th>
                        <th>@lang('global.resultados.fields.fecha')</th>
                    
                        <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($laboratorios) > 0)
                        @foreach ($laboratorios as $lab)
                            <tr data-entry-id="{{ $lab->id }}">
                                <td></td>

                                <td>{{ $lab->detalleservicio }}</td>
                                <td>{{ $lab->nombres }},{{ $lab->apellidos }}</td>
                                <td>{{ $lab->name }},{{ $lab->ape }}</td>
                                <td>{{ $lab->created_at }}</td>

                                <td>

                                     @if ($lab->status_redactar_resultados==1)
                                     <a href="{{ route('resultados_lab',['id'=>$lab->id]) }}" target="_blank" class="btn btn-xs btn-success">@lang('global.app_view')</a>
                                     @else
                                    <a href="{{ route('admin.resultados.create',['id'=>$lab->id]) }}" class="btn btn-xs btn-info">@lang('global.app_create_resultado')</a>
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

