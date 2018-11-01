<!DOCTYPE html>
<html lang="en">
<head>
	<title>Recibo de Profesional</title>
	<link rel="stylesheet" type="text/css" href="css/pdf.css">

</head>
<body>

	<p style="text-align: left;"><center><h1>{{Auth::user()->empresa}}</h1></center></p>
	<br>
  @foreach($profesional as $prof)
  <p style="margin-left: 15px;"><strong>DOCTOR:  </strong>{{ $prof["name"]}},{{ $prof["apellidos"]}}</p>
  <p style="margin-left: 15px;"><strong>CONSULTORIO:  </strong>{{ $prof["centro"]}}</p>
  @endforeach
  <p style="margin-left: 15px;"><strong>RECIBO:  </strong>{{$recibo}}</p>

  
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
   @foreach($reciboprofesional as $recibo)
  <tr>
    <td>{{ $recibo->nombres.' '.$recibo->apellidos}} </td>
    <td>{{ $recibo->fecha}} </td>
    <td>{{ $recibo->detalle}} </td>
    <td>{{ $recibo->pagar}} </td>
  </tr>
  @endforeach
 </tbody>

 @foreach($comisiones_lab_pag as $lab)
 @foreach($comisiones_serv_pag as $serv)

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

