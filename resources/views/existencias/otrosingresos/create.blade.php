@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.otrosingresos.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.otrosingresos.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">

          
           <div class="row">
           <div class="col-md-6">
           <div id="tipo_servicio" class="form-group error-status">
                {!! Form::label("tipo_ingreso","* Tipo de Ingreso",["class"=>""]) !!}
                <div class="input-icon">
                    <div class="input-icon">
                        <i class="icon-eye  font-red"></i>
                        
                        {!! Form::select('tipo_ingreso', ['0' => 'Seleccionar Tipo de Ingreso','EF' => 'Ingreso en Efectivo', 'TJ' => 'Ingreso con Tarjeta'], null, ['id'=>'tipo', 'class'=>'form-control select2']) !!}
                    </div>

                </div>
             </div> 
            </div>

              <div class="col-md-6">
                    {!! Form::label('monto', 'Monto de Ingreso', ['class' => 'control-label']) !!}
                    {!! Form::text('monto', old('monto'), ['class' => 'form-control', 'placeholder' => 'Ingrese el Monto', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('monto'))
                        <p class="help-block">
                            {{ $errors->first('monto') }}
                        </p>
                    @endif
                </div>

               
            </div>

        <div class="row">
        	 <div class="col-md-6">
                    {!! Form::label('descripcion', 'Descripciòn de Ingreso*', ['class' => 'control-label']) !!}
                    {!! Form::text('descripcion', old('descripcion'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('descripcion'))
                        <p class="help-block">
                            {{ $errors->first('descripcion') }}
                        </p>
                    @endif
           </div>
           <div class="col-md-6">
                {!! Form::label("causa","*Causa de Ingreso",["class"=>""]) !!}
                <div class="input-icon">
                    <div class="input-icon">
                        <i class="icon-eye  font-red"></i>
                        
                        {!! Form::select('causa', ['0' => 'Seleccione Causa de Ingreso','V' => 'Ventas', 'CC' => 'Cuentas por Cobrar', 'O' => 'Otros'], null, ['id'=>'tipo', 'class'=>'form-control select2']) !!}
                    </div>

                </div>
        </div>
         
        </div>

   

       
             
             
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript') 
    
 <script>
    $('#monto').priceFormat({
    prefix: '',
    thousandsSeparator: '',
    clearOnEmpty: true
    });
    </script>

  
@endsection

