<!DOCTYPE html>
<html lang="en">
<head>
	<title>Recibo de Profesional</title>
	<link rel="stylesheet" type="text/css" href="css/pdf.css">

</head>
<body>

	<p style="text-align: left;"><center><h1>{{Auth::user()->empresa}}</h1></center></p>
	<br>
@foreach($reciboprofesional as $recibo)

  <p style="margin-left: 15px;"><strong>DOCTOR:</strong>{{ $recibo->profnombre.' '.$recibo->profapellido }}</p>
  <p style="margin-left: 15px;"><strong>CONSULTORIO:</strong>{{ $recibo->centro}}</p>

  <br><br>

<table>
  <thead>
 <tr>
    <th scope="col">PACIENTE</th>
    <th scope="col">FECHA</th>
    <th scope="col">SERVICIO</th>
    <th scope="col">TOTAL PAGADO</th>
  </tr>
  </thead>
  <tbody>
  <tr>
    <td>{{ $recibo->nombres.' '.$recibo->apellidos }}</td>
    <td>{{ $recibo->fecha}}</td>
    <td>{{ $recibo->detalle}}</td>
    <td>{{ $recibo->porcentaje}}</td>
  </tr>
 </tbody>
</table>

 @endforeach

</body>
</html>

