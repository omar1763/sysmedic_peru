@extends('layouts.app')

@section('content')

<div class="modal fade" id="createPacienteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title disabled" id="modalTitle">Actualizar Paciente</h4>
                
               <!-- <small class="badge badge-danger">* Campos obligatorios</small>-->
            </div>
            <div id="id_container_modal_render" class="modal-body">

            </div>
            <div class="modal-footer">
               
               <!-- <button type="button" id="save-btn" class="btn green">Guardar</button>-->
               <button type="button" class="btn red btn-outline" data-dismiss="modal">Cerrar</button>
              
            </div>
        </div>
    </div>
</div>
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
                    {!! Form::select('pacientes', $pacientes, old('pacientes'), ['id'=>'paciente','class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('pacientes'))
                        <p class="help-block">
                            {{ $errors->first('pacientes') }}
                        </p>
                    @endif
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <a id="btn_add" onclick="addCiente()" style="margin-top:25px;" class="btn btn-danger">
                      <i class="glyphicon glyphicon-plus"></i>
                    </a>
                  </div>
                </div>


            </div>

          <div class="row">
             <div class="col" id="pac">

             </div>
          </div>
              <div class="row">
          
          <div class="col-md-6">
            <div id="origen_paciente" class="form-group error-status">
              {!! Form::label("origen_paciente","* Origen del Paciente",["class"=>""]) !!}
              <div class="input-icon">
                <div class="input-icon">
                  <i class="icon-eye  font-red"></i>
                  
                  {!! Form::select('origen_paciente', ['0' => 'Seleccionar Origen del Paciente','P' => 'Personal', 'PRO' => 'Profesional'], null, ['id'=>'tipoO', 'class'=>'form-control select2']) !!}
                </div>

              </div>
            </div> 
          </div>

         <div class="col-md-6 id="pac">

          </div>

          <div class="col-md-6" id="origen">

          </div>

        </div>
            
           <div class="row">
             <div class="col-md-6">
              {!! Form::label('servicios', 'Servicio*', ['class' => 'control-label']) !!}

             <select name="servicio[]" class="form-control select2"  multiple="multiple">
                        @foreach($servicios as $data)

                        @if(in_array($data->id, $servicioIds))
                        <option value="{{ $data->id }}" selected="true">{{ $data->detalle }}</option>
                        @else
                        <option value="{{ $data->id }}">{{ $data->detalle }}</option>
                        @endif 
                        @endforeach
                    </select>
                    <p class="help-block"></p>
                    @if($errors->has('servicios'))
                        <p class="help-block">
                            {{ $errors->first('servicios') }}
                        </p>
                    @endif
            </div>
            <div class="col-md-3">
              {!! Form::label('precioserv', 'Monto Servicios', ['class' => 'control-label']) !!}
              {!! Form::text('precioserv', old('precioserv'), ['class' => 'form-control', 'placeholder' => '']) !!}
              <p class="help-block"></p>
              @if($errors->has('precioserv'))
              <p class="help-block">
                {{ $errors->first('precioserv') }}
              </p>
              @endif
            </div>
              <div class="col-md-3">

              {!! Form::label('porcentajeserv', 'Porcentaje Servicios', ['class' => 'control-label']) !!}
              {!! Form::text('porcentajeserv', old('porcentajeserv'), ['class' => 'form-control', 'placeholder' => 'Solo para Profesionales']) !!}
              <p class="help-block"></p>
              @if($errors->has('porcentajeserv'))
              <p class="help-block">
                {{ $errors->first('porcentajeserv') }}
              </p>
              @endif
          </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              {!! Form::label('analises', 'Analisis de Laboratorio*', ['class' => 'control-label']) !!}

              <select name="analises[]" class="form-control select2"  multiple="multiple">
                @foreach($analisis as $data)

                @if(in_array($data->id, $analisisIds))
                <option value="{{ $data->id }}" selected="true">{{ $data->name }}</option>
                @else
                <option value="{{ $data->id }}">{{ $data->name }}</option>
                @endif 
                @endforeach
              </select>
              <p class="help-block"></p>
              @if($errors->has('servicios'))
              <p class="help-block">
                {{ $errors->first('servicios') }}
              </p>
              @endif



            </div>

             <div class="col-md-3">

              {!! Form::label('preciopublico', 'Monto Analisis', ['class' => 'control-label']) !!}
              {!! Form::text('preciopublico', old('preciopublico'), ['class' => 'form-control', 'placeholder' => '']) !!}
              <p class="help-block"></p>
              @if($errors->has('preciopublico'))
              <p class="help-block">
                {{ $errors->first('preciopublico') }}
              </p>
              @endif
          </div>
           <div class="col-md-3">

              {!! Form::label('porcentajelab', 'Porcentaje Analisis', ['class' => 'control-label']) !!}
              {!! Form::text('porcentajelab', old('porcentajelab'), ['class' => 'form-control', 'placeholder' => 'Solo para Profesionales']) !!}
              <p class="help-block"></p>
              @if($errors->has('porcentajelab'))
              <p class="help-block">
                {{ $errors->first('porcentajelab') }}
              </p>
              @endif
          </div>
        </div>

          <div class="row"> 
           <div class="col-md-6">
            {!! Form::label('paquetes', 'Paquetes*', ['class' => 'control-label']) !!}
            {!! Form::select('paquetes[]', $paquetes, old('paquetes'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'onchange'=>"ajaxLoadSelect3('/existencias/atencion/cardainput3', 'analises',$(this).val())"]) !!}
            <p class="help-block"></p>
            @if($errors->has('paquetes'))
            <p class="help-block">
              {{ $errors->first('paquetes') }}
            </p>
            @endif
          </div>

          <div class="col-md-3">

            {!! Form::label('costo', 'Monto Paquetes', ['class' => 'control-label']) !!}
            {!! Form::text('costo', old('costo'), ['class' => 'form-control', 'placeholder' => '']) !!}
            <p class="help-block"></p>
            @if($errors->has('costo'))
            <p class="help-block">
              {{ $errors->first('costo') }}
            </p>
            @endif
          </div>

           <div class="col-md-3">

              {!! Form::label('porcentajepaq', 'Porcentaje Paquetes', ['class' => 'control-label']) !!}
              {!! Form::text('porcentajepaq', old('porcentajepaq'), ['class' => 'form-control', 'placeholder' => 'Solo para Profesionales']) !!}
              <p class="help-block"></p>
              @if($errors->has('porcentajepaq'))
              <p class="help-block">
                {{ $errors->first('porcentajepaq') }}
              </p>
              @endif
          </div>

        </div>
          <div class="row">

               <div class="col-md-6">
               </div>

               <div class="col-md-3"">

              {!! Form::label('preciototal', 'Monto Total', ['id'=>'MiTotal','class' => 'control-label']) !!}
              {!! Form::text('preciototal', old('preciototal'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
              <p class="help-block"></p>
              @if($errors->has('preciototal'))
              <p class="help-block">
                {{ $errors->first('preciototal') }}
              </p>
              @endif
            </div>

            
          </div>



        <div class="row">
          
          <div class="col-md-6 id="ser">

         </div>
        </div>

    

        <div class="row">
         <div class="col-md-6">
          {!! Form::label("acuenta","*A cuenta",["class"=>""]) !!}
          <div class="input-icon">
            <div class="input-icon">
              <i class="icon-eye  font-red"></i>

              {!! Form::select('acuenta', ['0' => 'Seleccione una Opciòn','EF' => 'Pago en Efectivo', 'TJ' => 'Pago con Tarjeta'], null, ['id'=>'pago', 'class'=>'form-control select2']) !!}
            </div>

          </div>
        </div>

        <div class="col-md-6">
          {!! Form::label('costoa', 'Monto a Abonar', ['class' => 'control-label']) !!}
          {!! Form::text('costoa', old('costoa'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
          <p class="help-block"></p>
          @if($errors->has('costoa'))
          <p class="help-block">
            {{ $errors->first('costoa') }}
          </p>
          @endif
        </div>
      </div>

        <div class="row">
          <div class="col-md-6">
            {!! Form::label('tarjeta', 'Datos de Tarjeta', ['class' => 'control-label']) !!}
            {!! Form::text('tarjeta', old('tarjeta'), ['class' => 'form-control', 'placeholder' => '']) !!}
            <p class="help-block"></p>
            @if($errors->has('tarjeta'))
            <p class="help-block">
              {{ $errors->first('tarjeta') }}
            </p>
            @endif
          </div>
          <div class="col-md-6">
            {!! Form::label('observaciones', 'Observaciones', ['class' => 'control-label']) !!}
            {!! Form::text('observaciones', old('observaciones'), ['class' => 'form-control', 'placeholder' => '']) !!}
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
       function addCiente(){        
       javascript:ajaxLoad("{{ route('pacientes.createmodal') }}","id_container_modal_render");
         $('#createPacienteModal').modal('show');
       }
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
        $('#paciente').on('change',function(){
          var link;
            link = '/existencias/atencion/dataPacientes/'+$(this).val();
          $.ajax({
                 type: "get",
                 url:  link,
                 success: function(a) {
                    $('#pac').html(a);
                 }
          });

        });
        

      });
       
    </script>

     <script type="text/javascript">
      $(document).ready(function(){
        $('#servbyemp').on('change',function(){
          var link;
            link = '/existencias/atencion/dataServicios/'+$(this).val();
          $.ajax({
                 type: "get",
                 url:  link,
                 success: function(a) {
                    $('#ser').html(a);
                 }
          });

        });
        
      });
       
    </script>

  <script>
    $('#precio').priceFormat({
    prefix: '',
    thousandsSeparator: '',
    clearOnEmpty: true
    });
    </script>


  <script>
    $('#porcentaje').priceFormat({
    prefix: '',
    thousandsSeparator: '',
    clearOnEmpty: true
    });
    </script>


     <script>
    $('#acuenta').priceFormat({
    prefix: '',
    thousandsSeparator: '',
    clearOnEmpty: true
    });
    </script>

     <script>
    $('#costoa').priceFormat({
    prefix: '',
    thousandsSeparator: '',
    clearOnEmpty: true
    });
    </script>

    <script>
    $('#precioserv').priceFormat({
    prefix: '',
    thousandsSeparator: '',
    clearOnEmpty: true
    });
    </script>

     <script>
    $('#preciopublico').priceFormat({
    prefix: '',
    thousandsSeparator: '',
    clearOnEmpty: true
    });
    </script>

     <script>
    $('#preciototal').priceFormat({
    prefix: '',
    thousandsSeparator: '',
    clearOnEmpty: true
    });
     </script>

     <script>
    $('#porcentajeserv').priceFormat({
    prefix: '',
    thousandsSeparator: '',
    clearOnEmpty: true
    });
     </script>

     <script>
    $('#porcentajelab').priceFormat({
    prefix: '',
    thousandsSeparator: '',
    clearOnEmpty: true
    });
     </script>

     <script>
    $('#porcentajepaq').priceFormat({
    prefix: '',
    thousandsSeparator: '',
    clearOnEmpty: true
    });
     </script>

@endsection

