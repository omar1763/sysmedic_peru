<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ticket de Atenciòn</title>
	<link rel="stylesheet" type="text/css" href="css/pdf.css">

</head>
<body>

 @if($usuarioEmp =='13')
 @foreach($atencion as $atec)

    <div class="" style="font-size: 30px; text-align: center;">
		<p><strong>FECHA:{{ $atec->created_at}}</strong></p>
	</div>

	<div class="" style="font-size: 30px; text-align: center;">
		<p><strong>PACIENTE:{{ $atenciondetalle->selectPaciente($atec->id_paciente) }}</strong></p>
	</div>

	<div class="" style="font-size: 30px; text-align: center;">
		<p><strong>SERVICIOS:
			@if($servicios->selectAllServicios($atec->id_atencion))
			{{$servicios->selectAllServicios($atec->id_atencion)}}
			@else
			Sin Servicios
			@endif
		</strong></p>
	</div>

	<div class=""  style="font-size: 30px; text-align: center;">
		<p><strong> LABORATORIOS:
			@if($analisis->selectAllAnalisis($atec->id_atencion))
			{{$analisis->selectAllAnalisis($atec->id_atencion)}}
			@else
			Sin Laboratorios
			@endif
		</strong></p>
	</div>

	<div class="" style="font-size: 30px; text-align: center;">
		<p><strong>A CUENTA:{{ $atec->costoa}}</strong></p>
	</div>

	<div class="" style="font-size: 30px; text-align: center;">
		<p><strong>DEUDA: {{ $atec->pendiente}},00</strong></p>
	</div>

	<div class="" style="font-size: 30px; text-align: center;">
		<p><strong>TOTAL: {{ $atec->costo}},00</strong></p>
	</div>

	<div class="" style="font-size: 30px; text-align: center;">
		<p><strong>Origen:{{ $atec->name}},{{ $atec->apellidos}}</strong></p>
	</div>

@endforeach

@endif

@if($usuarioSuc =='16')
 @foreach($atencion as $atec)

    <div class="" style="font-size: 30px; text-align: center;">
		<p><strong>MADRE TERESA- INDEPENDENCIA</strong></p>
	</div>

    <div class="" style="font-size: 30px; text-align: center;">
		<p><strong>FECHA:{{ $atec->created_at}}</strong></p>
	</div>

	<div class="" style="font-size: 30px; text-align: center;">
		<p><strong>PACIENTE:{{ $atenciondetalle->selectPaciente($atec->id_paciente) }}</strong></p>
	</div>

	<div class="" style="font-size: 30px; text-align: center;">
		<p><strong>SERVICIOS:
			@if($servicios->selectAllServicios($atec->id_atencion))
			{{$servicios->selectAllServicios($atec->id_atencion)}}
			@else
			Sin Servicios
			@endif
		</strong></p>
	</div>

	<div class=""  style="font-size: 30px; text-align: center;">
		<p><strong> LABORATORIOS:
			@if($analisis->selectAllAnalisis($atec->id_atencion))
			{{$analisis->selectAllAnalisis($atec->id_atencion)}}
			@else
			Sin Laboratorios
			@endif
		</strong></p>
	</div>

	<div class="" style="font-size: 30px; text-align: center;">
		<p><strong>A CUENTA:{{ $atec->costoa}}</strong></p>
	</div>

	<div class="" style="font-size: 30px; text-align: center;">
		<p><strong>DEUDA: {{ $atec->pendiente}},00</strong></p>
	</div>

	<div class="" style="font-size: 30px; text-align: center;">
		<p><strong>TOTAL: {{ $atec->costo}},00</strong></p>
	</div>

	<div class="" style="font-size: 30px; text-align: center;">
		<p><strong>Origen:{{ $atec->name}},{{ $atec->apellidos}}</strong></p>
	</div>

@endforeach

@endif


@if($usuarioSuc =='17')
 @foreach($atencion as $atec)

    <div class="" style="font-size: 30px; text-align: center;">
		<p><strong>MADRE TERESA- LOS OLIVOS</strong></p>
	</div>

    <div class="" style="font-size: 30px; text-align: center;">
		<p><strong>FECHA:{{ $atec->created_at}}</strong></p>
	</div>

	<div class="" style="font-size: 30px; text-align: center;">
		<p><strong>PACIENTE:{{ $atenciondetalle->selectPaciente($atec->id_paciente) }}</strong></p>
	</div>

	<div class="" style="font-size: 30px; text-align: center;">
		<p><strong>SERVICIOS:
			@if($servicios->selectAllServicios($atec->id_atencion))
			{{$servicios->selectAllServicios($atec->id_atencion)}}
			@else
			Sin Servicios
			@endif
		</strong></p>
	</div>

	<div class=""  style="font-size: 30px; text-align: center;">
		<p><strong> LABORATORIOS:
			@if($analisis->selectAllAnalisis($atec->id_atencion))
			{{$analisis->selectAllAnalisis($atec->id_atencion)}}
			@else
			Sin Laboratorios
			@endif
		</strong></p>
	</div>

	<div class="" style="font-size: 30px; text-align: center;">
		<p><strong>A CUENTA:{{ $atec->costoa}}</strong></p>
	</div>

	<div class="" style="font-size: 30px; text-align: center;">
		<p><strong>DEUDA: {{ $atec->pendiente}},00</strong></p>
	</div>

	<div class="" style="font-size: 30px; text-align: center;">
		<p><strong>TOTAL: {{ $atec->costo}},00</strong></p>
	</div>

	<div class="" style="font-size: 30px; text-align: center;">
		<p><strong>Origen:{{ $atec->name}},{{ $atec->apellidos}}</strong></p>
	</div>

@endforeach

@endif



@if($usuarioSuc =='8')
@foreach($atencion as $atec)


<div class="paciente">
		<p><strong>{{ $atenciondetalle->selectPaciente($atec->id_paciente) }}</strong></p>
	</div>

	<div class="fecha">
		<p><strong>{{ $atec->created_at}}</strong></p>
	</div>
	<div class="servicios">
		<p><strong>
			@if($servicios->selectAllServicios($atec->id_atencion))
			{{$servicios->selectAllServicios($atec->id_atencion)}}
			@else
			Sin Servicios
			@endif
		</strong></p>
	</div>

	<div class="analisis">
		<p><strong> 
			@if($analisis->selectAllAnalisis($atec->id_atencion))
			{{$analisis->selectAllAnalisis($atec->id_atencion)}}
			@else
			Sin Laboratorios
			@endif
		</strong></p>
	</div>

	<div class="acuenta">
		<p><strong>A Cuenta:{{ $atec->costoa}}</strong></p>
	</div>

	<div class="pendiente">
		<p><strong>Deuda: {{ $atec->pendiente}},00</strong></p>
	</div>

	<div class="" style="margin-left: 50px; margin-top: -25px;">
		<p><strong>Origen:{{ $atec->name}},{{ $atec->apellidos}}</strong></p>
	</div>

	<div class="total">
		<p><strong>{{ $atec->costo}},00</strong></p>
	</div>



@endforeach
@endif



</body>
</html>