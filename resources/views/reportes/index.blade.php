@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
   <div class="row">
	<div id="paginacion">
		<div class="col-md-8 col-sm-8 col-xs-8">
			<div class="card">
				<div class="card-action">
				<div class="col s6">
					<h3>Reporte de Atenciòn Diaria</h3>
				</div>	
				 {!! Form::open(['method' => 'GET', 'route' => ['listado_atenciondiaria_ver']]) !!}

				<div class="input-field col s6">
				</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						{!! Form::label('fecha', 'Fecha', ['class' => 'control-label']) !!}
						{!! Form::date('fecha', old('fechanac'), ['id'=>'fecha','class' => 'form-control', 'placeholder' => '']) !!}
						<p class="help-block"></p>
						@if($errors->has('fecha'))
						<p class="help-block">
							{{ $errors->first('fecha') }}
						</p>
						@endif
					</div>
					
					<div class="col-md-4">
						

					</div>
				</div>
			
			</div>
		</div>
			<div class="col-md-8 col-sm-8 col-xs-8 edit">

			</div>
	</div>

</div>

<!-- Recursos javascript-ajax -->

 {!! Form::submit(trans('global.app_search'), array('class' => 'btn btn-danger')) !!}
 {!! Form::close() !!}
@stop

@section('javascript') 
   
@endsection
