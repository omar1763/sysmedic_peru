@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Cuentas por Cobrar')</h3>
    
        {!! Form::model($cuentasporcobrar, ['method' => 'DELETE', 'route' => ['admin.cuentasporcobrar.destroy', $cuentasporcobrar->id]]) !!}


    <div class="panel panel-default">
        

        <div class="panel-body">
        	<div class="row">
        		    <td><strong>Monto Pendiente:</strong>{!!$pagar!!}</td>
        	</div>
        	<br>
          <div class="row">
                <div class="col-md-4">
                    {!! Form::label('pagar', 'Monto a Cobrar*', ['class' => 'control-label']) !!}
                    {!! Form::text('pagar', old('pagar'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('pagar'))
                        <p class="help-block">
                            {{ $errors->first('pagar') }}
                        </p>
                    @endif
                </div>
            </div>
        
              

            
        </div>
    </div>

    {!! Form::submit(trans('Cobrar'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@include('partials.javascripts')

@section('javascript') 

 <script>
    $('#pagar').priceFormat({
    prefix: '',
    thousandsSeparator: '',
    clearOnEmpty: true
    });
    </script>

   
  

@endsection

