<!DOCTYPE html>
<html lang="en">
<head>
	<title>Recibo de Profesional</title>
	<link rel="stylesheet" type="text/css" href="css/pdf.css">

</head>
<body>

	<p style="text-align: left;"><center><h1>{{Auth::user()->empresa}}</h1></center></p>
	<br>
  
  <p style="margin-left: 15px;"><strong>DOCTOR:</strong>{{ $profnombre.' '.$profapellido }}</p>
  <p style="margin-left: 15px;"><strong>CONSULTORIO:</strong>{{ $centro}}</p>
  <p style="margin-left: 15px;"><strong>RECIBO:</strong>{{ $recibo}}</p>

  
<table>
  <thead>
 <tr>
    <th scope="col">PACIENTE</th>
    <th scope="col">FECHA</th>
    <th scope="col">DETALLE</th>
  </tr>
  </thead>

  <tbody>
  @foreach($reciboprofesional as $recibo)
  <tr>
    <td>{{ $recibo["nombres"].' '.$recibo["apellidos"] }}</td>
    <td>{{ $recibo["fecha"]}}</td>
    <td>{{ $recibo["detalle"]}}</td>
  </tr>
  @endforeach
 </tbody>
 <tr>
    <th scope="row">TOTAL SERVICIOS:</th>
    
    <td><strong>{{ $porcentaje}}</strong></td>
  </tr>
   <tr>
    <th scope="row">TOTAL LABORATORIOS:</th>
    
    <td><strong>{{ $recibo["porcentaje"]}}</strong></td>
  </tr>
</table>


</body>
</html>

