<!DOCTYPE html>
<html lang="en">
<head>
	<title>Resultado de Informe</title>
	<link rel="stylesheet" type="text/css" href="css/pdf.css">

</head>
<body>

	<p style="margin-left: 260px; font-size: 16px;"><strong>INFORME DE RESULTADOS</strong></p>
	<br>

	@foreach($laboratorios as $serv)

	<p style="margin-left: 150px;"><strong>PACIENTE:</strong>{{ $serv->nombres.' '.$serv->apellidos }}</p>
	<p style="margin-left: 150px;"><strong>EXAMEN/SERVICIO:</strong>{{ $serv->detalleservicio }}</p>
    <p style="margin-left: 150px;"><strong>INDICACIÒN:</strong></p>
    <p style="margin-left: 150px;"><strong>FECHA:</strong>{{ $serv->created_at}}</p>
    <br>

    <div style="margin-right: 80px; margin-left: 15px; text-align: justify; font-size: 16px; line-height: 1.6;">{!!html_entity_decode($serv->resultado)!!}</div>
  




	@endforeach



</body>
</html>