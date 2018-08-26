@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
   <div class="row">
	<div id="paginacion">
		<div class="col-md-8 col-sm-8 col-xs-8">
			<div class="card">
				<div class="card-action">
				<div class="col s6">
					<b3>Reporte de Atenciòn Diaria</b3>
				</div>			
				<div class="input-field col s6">
				</div>
				</div>
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
				<table class="table">
					<thead>
						<th>Id</th>
						<th>Reporte</th>
						<th>Ver</th>
						<th>Descargar</th>
						

				</thead>
				<tbody>
					
						<tr>
							<td>1</td>
							<td>Atenciòn Diarìa</td>
				
							 <td>
                                <a href="{{asset('listado_atenciondiaria_ver')}}" class=" waves-effect waves-light btn" target="_blank">Ver</a>
                            </td>

                              <td>
                                <a href="{{asset('listado_enviadas_descargar')}}" class=" waves-effect waves-light btn">Descargar</a>
                            </td>

						</tr>

							
					

				</tbody>
				</table>
			
			</div>
		</div>
			<div class="col-md-8 col-sm-8 col-xs-8 edit">

			</div>
	</div>

</div>

<!-- Recursos javascript-ajax -->

@stop

@section('javascript') 
   
@endsection
