@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.comisionespagadas.title')</h3>
   
      {!! Form::open(['method' => 'get', 'route' => ['admin.comisionespagadas.index']]) !!}



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
            <table class="table table-bordered table-striped {{ count($comisionespagadas) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
            
                        <th>@lang('global.comisionespagadas.fields.profesional')</th>

                        <th>@lang('global.comisionespagadas.fields.comision')</th>
                        
                        <th>@lang('global.comisionespagadas.fields.fecha')</th>
                        <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($comisionespagadas) > 0)
                        @foreach ($comisionespagadas as $com)
                            <tr data-entry-id="{{ $com->id }}">
                                <td></td>
                              
                                <td>{{ $com->profnombre.' '.$com->profapellido }}</td>
                                <td>{{ $com->porcentaje}}</td>
                                <td>{{ $com->fecha}}</td>
                                <td> 
                                  <a  target="_blank" href="{{asset('recibo_profesionales_ver')}}/{{$com->id}}" class="btn btn-xs btn-success">@lang('global.app_imprimirr')</a>
                                    
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
         <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($comisionespagadaslab) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>@lang('global.comisionesporpagar.fields.paciente')</th>
                        <th>@lang('global.comisionesporpagar.fields.profesional')</th>
                       
                        <th>@lang('global.comisionesporpagar.fields.servicio')</th>
                        <th>@lang('global.comisionesporpagar.fields.montototal')</th>
                        
                        <th>@lang('global.comisionesporpagar.fields.comision')</th>
                        
                        <th>@lang('global.comisionesporpagar.fields.fecha')</th>
                        <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($comisionespagadaslab) > 0)
                        @foreach ($comisionespagadaslab as $com)
                            <tr data-entry-id="{{ $com->id }}">
                                <td></td>
                                <td>{{ $com->nombres.' '.$com->apellidos }}</td>
                                <td>{{ $com->profnombre.' '.$com->profapellido }}</td>
                                <td>{{ $com->name}}</td>
                                <td>{{ $com->costo}}</td>
                                <td>{{ $com->porcentaje}}</td>
                                <td>{{ $com->fecha}}</td>
                                <td> 
                   
                                    <a  target="_blank" href="{{asset('recibo_profesionales_ver')}}/{{$com->id}}" class="btn btn-xs btn-success">@lang('global.app_imprimirr')</a>
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

@section('javascript') 
    <script>
        window.route_mass_crud_entries_destroy = '{{ route('admin.comisionespagadas.mass_destroy') }}';
    </script>
@endsection
