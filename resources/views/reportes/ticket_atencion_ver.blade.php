<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ticket de Atenciòn</title>
	<link rel="stylesheet" type="text/css" href="css/pdf.css">

</head>
<body>

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
			@endif
		</strong></p>
	</div>

	<div class="analisis">
		<p><strong> 
			@if($analisis->selectAllAnalisis($atec->id_atencion))
			{{$analisis->selectAllAnalisis($atec->id_atencion)}}
			@else
			@endif
		</strong></p>
	</div>

	<div class="acuenta">
		<p><strong>A Cuenta:{{ $atec->costoa}}</strong></p>
	</div>

	<div class="pendiente">
		<p><strong>Deuda: {{ $atec->pendiente}},00</strong></p>
	</div>

	<div class="total">
		<p><strong>{{ $atec->costo}},00</strong></p>
	</div>

	@endforeach



</body>
</html>