@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.atencion.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.atencion.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">

           <div class="row">
                <div class="col-md-6">
                    {!! Form::label('pacientes', 'Pacientes*', ['class' => 'control-label']) !!}
                    {!! Form::select('pacientes', $pacientes, old('pacientes'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('pacientes'))
                        <p class="help-block">
                            {{ $errors->first('pacientes') }}
                        </p>
                    @endif
                </div>

            </div>
            
           <div class="row">
           	<div class="col-md-6">
           <div id="tipo_servicio" class="form-group error-status">
                {!! Form::label("tipo_servicio","* Tipo de Servicio",["class"=>""]) !!}
                <div class="input-icon">
                    <div class="input-icon">
                        <i class="icon-eye  font-red"></i>
                        
                        {!! Form::select('tipo_servicio', ['0' => 'Seleccionar Tipo de Servicio','P' => 'Paquete', 'S' => 'Servicio'], null, ['id'=>'tipo', 'class'=>'form-control select2']) !!}
                    </div>

                </div>
            </div> 
        </div>

                <div class="col-md-6" id="servbyemp">
                    
                </div>
        </div>

        <div class="row">
          
          <div class="col-md-6">
          <div id="origen_paciente" class="form-group error-status">
                {!! Form::label("origen_paciente","* Origen del Paciente",["class"=>""]) !!}
                <div class="input-icon">
                    <div class="input-icon">
                        <i class="icon-eye  font-red"></i>
                        
                        {!! Form::select('origen_paciente', ['0' => 'Seleccionar Origen del Paciente','P' => 'Personal', 'PR' => 'Profesional'], null, ['id'=>'tipoO', 'class'=>'form-control select2']) !!}
                    </div>

                </div>
            </div> 
        </div>

        <div class="col-md-6" id="origen">
                    
                </div>
        </div>

        <div class="row">
           <div class="col-md-6">
                <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('precio', 'Precio', ['class' => 'control-label']) !!}
                    {!! Form::text('precio', old('precio'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('precio'))
                        <p class="help-block">
                            {{ $errors->first('precio') }}
                        </p>
                    @endif
                </div>
            </div>

           </div>
           <div class="col-md-6">
                <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('porcentaje', 'Porcentaje*', ['class' => 'control-label']) !!}
                    {!! Form::text('porcentaje', old('porcentaje'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('porcentaje'))
                        <p class="help-block">
                            {{ $errors->first('porcentaje') }}
                        </p>
                    @endif
                </div>
            </div>
             
           </div>
        </div>

        <div class="row">
           <div class="col-md-6">
          <div id="origen_paciente" class="form-group error-status">
                {!! Form::label("acuenta","*A cuenta",["class"=>""]) !!}
                <div class="input-icon">
                    <div class="input-icon">
                        <i class="icon-eye  font-red"></i>
                        
                        {!! Form::select('acuenta', ['0' => 'Seleccione una Opciòn','PA' => 'Pago Adelantado', 'PT' => 'Pago con Tarjeta'], null, ['id'=>'pago', 'class'=>'form-control select2']) !!}
                    </div>

                </div>
            </div> 
        </div>

        <div class="col-md-6" id="pagocuenta">

        </div>





        </div>

        <div class="row">
              <div class="col-md-6">
                <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('observaciones', 'Observaciones', ['class' => 'control-label']) !!}
                    {!! Form::text('observaciones', old('observaciones'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('observaciones'))
                        <p class="help-block">
                            {{ $errors->first('observaciones') }}
                        </p>
                    @endif
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
    

     <script type="text/javascript">
      $(document).ready(function(){
        $('#tipo').on('change',function(){
          var link;
          if ($(this).val() == 'S') {
            link = '/existencias/atencion/servbyemp/';
          }else{
            link = '/existencias/atencion/paqbyemp/';
          }

          $.ajax({
                 type: "get",
                 url:  link,
                 success: function(a) {
                    $('#servbyemp').html(a);
                 }
          });

        });
        

      });
       
    </script>

    <script type="text/javascript">
      $(document).ready(function(){
        $('#tipoO').on('change',function(){
          var link;
          if ($(this).val() == 'P') {
            link = '/existencias/atencion/perbyemp/';
          }else{
            link = '/existencias/atencion/probyemp/';
          }

          $.ajax({
                 type: "get",
                 url:  link,
                 success: function(a) {
                    $('#origen').html(a);
                 }
          });

        });
        

      });
       
    </script>


     <script type="text/javascript">
      $(document).ready(function(){
        $('#pago').on('change',function(){
          var link;
          if ($(this).val() == 'PA') {
            link = '/existencias/atencion/pagoadelantado/';
          }else{
            link = '/existencias/atencion/pagotarjeta/';
          }

          $.ajax({
                 type: "get",
                 url:  link,
                 success: function(a) {
                    $('#pagocuenta').html(a);
                 }
          });

        });
        

      });
       
    </script>

   <script>
    $('#precio').priceFormat({
    prefix: '',
    centsSeparator: ',',
    thousandsSeparator: '.'
    });
    </script>

   <script>
    $('#porcentaje').priceFormat({
    prefix: '',
    centsSeparator: ',',
    thousandsSeparator: '.'
    });
    </script>

     <script>
    $('#acuenta').priceFormat({
    prefix: '',
    centsSeparator: ',',
    thousandsSeparator: '.'
    });
    </script>



@endsection

