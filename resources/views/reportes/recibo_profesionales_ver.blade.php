<!DOCTYPE html>
<html lang="en">
<head>
	<title>Recibo de Profesional</title>
	<link rel="stylesheet" type="text/css" href="css/pdf.css">

</head>
<body>

	<p style="text-align: left;"><center><h1>{{Auth::user()->empresa}}</h1></center></p>
	<br>
  
  <p style="margin-left: 15px;"><strong>DOCTOR:  </strong>{{ $profnombre.' '.$profapellido }}</p>
  <p style="margin-left: 15px;"><strong>CONSULTORIO:  </strong>{{ $centro}}</p>
  <p style="margin-left: 15px;"><strong>RECIBO:  </strong>{{ $recibo}}</p>

  
<table>
  <thead>
 <tr>
    <th scope="col">PACIENTE</th>
    <th scope="col">FECHA</th>
    <th scope="col">DETALLE</th>
    <th scope="col">MONTO</th>
  </tr>
 
  </thead>
  <tbody>
  <?php $sum = 0; ?>
  @foreach($reciboprofesional as $recibo)
  <tr>
    <td>{{ $recibo["nombres"].' '.$recibo["apellidos"] }}</td>
    <td>{{ $recibo["fecha"]}}</td>
    <td>{{ $recibo["detalle"]}}</td>
    <td>{{ $recibo["pagar"]}}</td>
  </tr>
  @endforeach
 </tbody>

 @foreach($total_lab as $lab)
 @foreach($total_serv as $serv)

<?php 

 $lab_pag = $lab->total_lab;
 $serv_pag = $serv->total_serv;
 $total= $lab_pag+$serv_pag;

 ;?>


 <p><strong>TOTAL:  </strong>{!!$total!!}.00</p>
 
 @endforeach
 @endforeach



</table>


</body>
</html>

