@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
  
                 {!! Form::open(['action' => 'ReportesController@reportegeneral']) !!}
    
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">  REPORTE GENERAL</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
                <div class="row">
        <div class="col-md-3">
            {!! Form::label('desde', 'Desde', ['class' => 'control-label']) !!}
            {!! Form::date('desde', old('desde'), ['id'=>'desde','class' => 'form-control', 'placeholder' => '',]) !!}
            <p class="help-block"></p>
            @if($errors->has('desde'))
            <p class="help-block">
                {{ $errors->first('desde') }}
            </p>
            @endif
        </div>
          <div class="col-md-3">
            {!! Form::label('hasta', 'Hasta', ['class' => 'control-label']) !!}
            {!! Form::date('hasta', old('hasta'), ['id'=>'hasta','class' => 'form-control', 'placeholder' => '', ]) !!}
            <p class="help-block"></p>
            @if($errors->has('hasta'))
            <p class="help-block">
                {{ $errors->first('hasta') }}
            </p>
            @endif
        </div>
             <div class="col-md-3">
            {!! Form::label('tipo_ingreso', 'Tipo', ['class' => 'control-label']) !!}
            {!! Form::select('tipo_ingreso',  [
            '' => 'Seleccionar Tipo de Ingreso',
            'EF' => 'Ingreso en Efectivo', 
            'TJ' => 'Ingreso con Tarjeta'
            ], old('tipo_ingreso'), ['id'=>'tipo_ingreso','class' => 'form-control select2',]) !!}              
            <p class="help-block"></p>
            @if($errors->has('tipo_ingreso'))
            <p class="help-block">
                {{ $errors->first('tipo_ingreso') }}
            </p>
            @endif
        </div>
    
            <div class="col-md-3">
            {!! Form::label('origen', 'Origen', ['class' => 'control-label']) !!}
            {!! Form::select('origen', [
            ''=>'Seleccione el Origen',
            'CUENTAS POR COBRAR'=>'CUENTAS POR COBRAR',
            'INGRESO DE ATENCIONES'=>'INGRESO DE ATENCIONES',
            'OTROS INGRESOS'=>'OTROS INGRESOS',
            ], old('origen'), ['id'=>'origen','class' => 'form-control select2',]) !!}
            <p class="help-block"></p>
            @if($errors->has('origen'))
            <p class="help-block">
                {{ $errors->first('origen') }}
            </p>
            @endif
        </div>
       
       
        
    </div> 
              </div>
              <!-- /.box-body -->

              <div class="box-footer " style="text-align: right;">
              {!! Form::submit('GENERAR REPORTE', ['class' => 'btn btn-danger']) !!}
              </div>
            
          </div>

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
       function Consultar() {
    var desde = $('#desde').val() ? $('#desde').val() : 'no';
    var hasta = $('#hasta').val() ? $('#hasta').val() : 'no';
    var tipo_ingreso = $('#tipo_ingreso').val() ? $('#tipo_ingreso').val() : 'no';
    var origen = $('#origen').val() ? $('#origen').val() : 'no';
    $.ajax({
    
    type: 'POST',
    url: "/reportes/report-1",
    data: { 
      "_token": "{{ csrf_token() }}",
      "parameter" :{
        'desde': desde, 
        'hasta': hasta, 
        'tipo_ingreso': tipo_ingreso, 
        'origen': origen      
      }
    },
    beforeSend: function() {                
      
      alert("Antes del Envio");
    },
    success: function (data) {
    console.log(data);      
          let _blob = new Blob([data], {type : 'application/octet-stream'});
      var url = window.URL.createObjectURL(_blob);
      var a = document.createElement('a');
      document.body.appendChild(a);
      a.setAttribute('style', 'display: none');
      a.href = url;
      a.download = 'prueaba.pdf';
      a.click();
      window.URL.revokeObjectURL(url);  
      //ad.log(data);
    },
    error: function (data, textStatus, errorThrown) {
      alert("Ocurrio un Error");
      
      console.log(data);

    },
  });

//var parameter=desde+'*'+hasta+'*'+tipo+'*'+origen;    
   /* if (desde=='no') {
      alert("Debes Indicar el Tipo");
    } else {
      alert("llenos");
      
    }*/
  }
    </script>
  

   
@endsection
