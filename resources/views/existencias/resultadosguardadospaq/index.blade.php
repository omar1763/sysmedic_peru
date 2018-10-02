@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.resultadosguardadospaq.title')</h3>
   
      {!! Form::open(['method' => 'get', 'route' => ['admin.resultadosguardadospaq.index']]) !!}
        <div class="row">
        <div class="col-md-4">
            {!! Form::label('fecha', 'Seleccione una Fecha', ['class' => 'control-label']) !!}
            {!! Form::date('fecha', old('fechanac'), ['id'=>'fecha','class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
            <p class="help-block"></p>
            @if($errors->has('fecha'))
            <p class="help-block">
                {{ $errors->first('fecha') }}
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
            <table class="table table-bordered table-striped {{ count($paquetes) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>Atenciòn</th>
                        <th>Paquete</th>
                        <th>Detalle</th>
                        <th>Paciente</th>
                        <th>Profesional</th>
                        <th>@lang('global.resultadoslab.fields.fecha')</th>
                    
                        <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($paquetes) > 0)
                        @foreach ($paquetes as $paq)
                            <tr data-entry-id="{{ $paq->id }}">
                                <td></td>
                                <td>{{ $paq->id_atencion}}</td>
                                <td>{{ $paq->detalle}}</td>
                                <td>{{ $paq->detalle1}}</td>
                                <td>{{ $paq->pnombres }},{{ $paq->papellidos }}</td>
                                <td>{{ $paq->nombres }},{{ $paq->apellidos }}</td>
                                <td>{{ $paq->fecha }}</td>

                                <td>
                                      @if ($paq->status_redactar_resultados==1)
                                     <a href="{{ route('resultados_lab_paq',['id'=>$paq->id]) }}" target="_blank" class="btn btn-xs btn-success">@lang('global.app_view')</a>
                       
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

