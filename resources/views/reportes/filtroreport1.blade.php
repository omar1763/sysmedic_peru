@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Reporte General</h3>
   
      {!! Form::open(['method' => 'get', 'route' => ['filtros']]) !!}

      <div class="row">
         <div class="col-md-2">
            {!! Form::label('fecha', 'Fecha Inicio', ['class' => 'control-label']) !!}
            {!! Form::date('fecha', old('fechanac'), ['id'=>'fecha','class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
            <p class="help-block"></p>
            @if($errors->has('fecha'))
            <p class="help-block">
                {{ $errors->first('fecha') }}
            </p>
            @endif
        </div>
        <div class="col-md-2">
            {!! Form::label('fecha2', 'Fecha Fin', ['class' => 'control-label']) !!}
            {!! Form::date('fecha2', old('fecha2'), ['id'=>'fecha2','class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
            <p class="help-block"></p>
            @if($errors->has('fecha2'))
            <p class="help-block">
                {{ $errors->first('fecha2') }}
            </p>
            @endif
        </div>
         <div class="col-md-2">
            <div id="filtro" class="form-group error-status">
              {!! Form::label("filtro","* Otros",["class"=>""]) !!}
              <div class="input-icon">
                <div class="input-icon">
                  <i class="icon-eye  font-red"></i>
                  
                  {!! Form::select('filtro', ['0' => 'Seleccionar el Filtro','1' => 'Ventas', '2' => 'Gastos'], null, ['id'=>'filtrog', 'class'=>'form-control select2']) !!}
                </div>

              </div>
            </div> 
        </div>

        
    
        <div class="col-md-2">
            {!! Form::submit(trans('global.app_search'), array('class' => 'btn btn-info')) !!}
            {!! Form::close() !!}

        </div>
    </div>


     
    <div class="panel panel-default">
 
          <div class="panel-heading">
       
            @if($filtro =='1')
            <p><strong>Total:{{$totalcreditos->monto}}</strong></p>
            @elseif($filtro =='2')
            <p><strong>Total:{{$totalgastos->monto}}</strong></p>
            @elseif($filtro =='0')
            <p><strong>Total:{{$totalservicios->monto + $totallab->monto}}</strong></p>
            @else
            <p><strong>Total:0</strong></p>
            @endif

     </div>


        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($reporte) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @if($filtro =='0')
                        <th>Fecha</th>
                        <th>Origen</th>
                        <th>Paciente</th>
                        <th>Detalle</th>
                        <th>Precio</th>
                        <th>Porcentaje</th>
                        <th>A Cuenta</th>
                        <th>Monto a Pagar</th>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @elseif($filtro =='1')
                        <th>Fecha</th>
                        <th>Detalle de la Venta</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Tipo de Ingreso</th>
                        <th>Monto</th>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @elseif($filtro =='2')
                        <th>Fecha</th>
                        <th>Nombre</th>
                        <th>Detalle del Gasto</th>
                        <th>Monto</th>
                        <th></th>
                        @else
                        <th></th>
                        @endif

                    </tr>
                </thead>
                
                <tbody>
                     @if (count($reporte) > 0)
                        @foreach ($reporte as $rep)
                        <tr data-entry-id="{{ $rep->id }}">

                          <td></td>

                          <td>{{ $rep->fecha }}</td>
                          @if($filtro =='0')
                          <td>{{ $atenciondetalles->selectProfesional($rep->id_profesional) }}</td>                           
                          <td>{{ $atenciondetalles->selectPaciente($rep->id_paciente) }}</td>
                          <td>{{ $rep->detalle }}</td>
                          <td>{{ $rep->precio }}</td>
                          <td>{{ $rep->porcentaje }}</td>
                          <td>{{ $rep->costoa }}</td>
                          <td>{{ $rep->pagar }}</td>
                          @elseif($filtro =='1')
                          <td>{{ $rep->detalle }}</td>
                          <td>{{ $rep->producto }}</td>
                          <td>{{ $rep->cantidad }}</td>
                          <td>{{ $rep->tipo_ingreso }}</td>
                          <td>{{ $rep->precio }}</td>
                          @elseif($filtro =='2')
                          <td>{{ $rep->name }}</td>
                          <td>{{ $rep->concepto }}</td>
                          <td>{{ $rep->monto }}</td>
                          @else
                          <td></td>
                          @endif
                        
                          <td></td>
                        </tr>
                  
                        @endforeach
                    @else
                       
                    @endif
                   
                </tbody>
            </table>
        </div>


         
    </div>
@stop


