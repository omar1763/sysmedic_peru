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
           <div id="error-tipo_servicio" class="form-group error-status">
                {!! Form::label("tipo_servicio","* Tipo de Servicio",["class"=>""]) !!}
                <div class="input-icon">
                    <div class="input-icon">
                        <i class="icon-eye  font-red"></i>
                        {!! Form::select('tipo_servicio', ['1'=>'Servicio','2'=>'Paquete'], old('tipo_servicio'), ['class' => 'form-control select2',]) !!}
                    </div>

                </div>
                <span id="sp-error-tipo_servicio" class="help-block estatus-error"></span>
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
        $('#tipo_servicio').on('change',function(){
          var id= $('#tipo_servicio').val();
          var link= '{{asset("existencias/atencion/servbyemp")}}';
              link= link.replace('id',id);
          $.ajax({
                 type: "get",
                 url: link ,
                 success: function(a) {
                    $('#servbyemp').html(a);
                 }
          });

        });
    </script>







@endsection

