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
        @foreach ($comisiones_lab_pag as $lab_pag)
         @foreach ($comisiones_serv_pag as $serv_pag)


         <?php 

         $serv_pag = $serv_pag->total_serv;
         $lab_pag = $lab_pag->total_lab;
         $total = $serv_pag+$lab_pag;

         ;?>


         <p><strong>Total Pagado: {!!$total!!}.00</strong></p>

         @endforeach
         @endforeach

        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($comisionespagadas) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>Recibo</th>
                        <th>@lang('global.comisionespagadas.fields.profesional')</th>
                        <th>Fecha de Pago</th>
                        <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($comisionespagadas) > 0)
                        @foreach ($comisionespagadas as $com)
                            <tr data-entry-id="{{ $com["id"]}}">
                                <td></td>
                                <td>{{ $com["recibo"]}}</td>
                                <td>{{ $com["nombres"]}},{{ $com["apellidos"]}}</td>
                                <td>{{ $com["fecha_pago_comision"] }}</td>
                                <td> 
                                 @if(Auth::user()->rol!="Recepcionista")

                                  <a target="_blank" href="{{asset('recibo_profesionales_ver')}}/{{$com["recibo"]}}" class="btn btn-xs btn-success">@lang('global.app_imprimirr')</a>
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


