@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.resultados.title')</h3>
   
      {!! Form::open(['method' => 'get', 'route' => ['admin.resultados.index']]) !!}

    
  
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
                        <th>@lang('global.resultados.fields.nombre')</th>
                        <th>@lang('global.resultados.fields.apellido')</th>
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
                                <td>{{ $serv->nombres }}</td>
                                <td>{{ $serv->apellidos }}</td>
                                <td>{{ $serv->created_at }}</td>

                                <td>
                                     @if ($serv->status_redactar_resultados==1)
                                     <a href="{{ route('admin.resultados.create',['id'=>$serv->id]) }}" class="btn btn-xs btn-success">@lang('global.app_view')</a>
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

