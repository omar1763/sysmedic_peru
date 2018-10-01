@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.comisionesporpagar.title')</h3>
   
      {!! Form::open(['method' => 'get', 'route' => ['admin.comisionesporpagar.index']]) !!}

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


         <p><strong>Pendiente por Pagar: {!!$total!!}.00</strong></p>

         @endforeach
         @endforeach


     </div>


        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($comisiones) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>Atenciòn</th>
                        <th>@lang('global.comisionesporpagar.fields.profesional')</th>
                        <th>@lang('global.comisionesporpagar.fields.paciente')</th>

                       
                       <th>Detalle</th>

                        <th>P.Unit</th>
                        
                        <th>Porcentaje</th>

                        <th>Monto a Pagar</th>
                        
                        <th>@lang('global.comisionesporpagar.fields.fecha')</th>
                        <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($comisiones) > 0)
                        @foreach ($comisiones as $com)
                            <tr data-entry-id="{{ $com->id }}">

                                <td></td>
                                <td>{{ $com->id_atencion}}</td>
                                <td>{{ $com->nombres.' '.$com->apellidos }}</td>
                                <td>{{$com->pnombres.' '.$com->papellidos}}</td>
                                <td>{{ $com->detalle}}</td>
                                <td>{{ $com->precio}}</td>
                                <td>{{ $com->porcentaje}}</td>
                                <td>{{ $com->pagar}}</td>
                                <td>{{ $com->fecha}}</td>

                                <td> 
                                   
                                @if(Auth::user()->rol!="Recepcionista")
                                   @if($com->origen=="Servicios")
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.comisionesporpagar.destroy', $com->id])) !!}
                                    {!! Form::submit(trans('global.app_pay'), array('class' => 'btn btn-xs btn-info')) !!}
                                    {!! Form::close() !!}
                                    @else
                                     {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'PUT',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.comisionesporpagar.destroylab', $com->id])) !!}
                                    {!! Form::submit(trans('global.app_pay'), array('class' => 'btn btn-xs btn-info')) !!}
                                    {!! Form::close() !!}
     
                                @endif
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

@section('javascript') 
    <script>
        window.route_mass_crud_entries_destroy = '{{ route('admin.comisionesporpagar.mass_destroy') }}';
    </script>
@endsection
