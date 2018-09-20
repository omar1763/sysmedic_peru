<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Reporte de Atenciones Diarias</title>
  	<link rel="stylesheet" type="text/css" href="css/pdf.css">

  </head>
  <body>

  <p style="text-align: left;"><center><STRONG>EMPRESA:</STRONG>{{Auth::user()->empresa}}</center></p>
  <p style="text-align: left;"><center><STRONG>SUCURSAL:</STRONG>{{Auth::user()->sucursal}}</center></p>

  <br>
 
  <p style="margin-left: 15px; float: left;">Fecha de Impresiòn:<?=date('d/m/Y');?></p>
  <p style="margin-left: 350px; float:left;">Hora de Impresiòn:<?=date('g:ia');?></p>
  <br>
  <p style="margin-left: -178px; float: left;">Fecha de Consulta:{!!$fecha!!}</p>

 
  <br><br><br>
 @foreach($creditos as $ingresos)

<table>
  <tr>
    <th scope="col">INGRESOS</th>
    <th scope="col">CANTIDAD</th>
    <th scope="col">MONTO</th>
  </tr>
  <tr>
    <td>Servicios</td>
    @foreach($servicios as $serv)
    <td>{{ $serv->total_servicios}}</td>
    @endforeach
    @foreach($serviciosmonto as $servmonto)
    <td>{{ $servmonto->total_monto_servicios}}</td>
    @endforeach
  </tr>
 
  <tr>
    <td>Otros Ingresos</td>
     @foreach($otrosingresos as $otros)
    <td>{{ $otros->total_otrosingresos}}</td>
     @endforeach
    @foreach($otrosingresosmonto as $otrosmonto)
    <td>{{ $otrosmonto->total_monto_otrosingresos}}</td>
    @endforeach

  </tr>
 
  <tr>
    <td>Cuentas por Cobrar</td>
    @foreach($ingresoscxc as $cxc)
    <td>{{ $cxc->total_cxc}}</td>
    @endforeach
    @foreach($ingresoscxcmonto as $cxcmonto)
    <td>{{ $cxcmonto->total_monto_cxc}}</td>
    @endforeach
  </tr>
 
  <tr>
    <th scope="row">TOTAL</th>
    <td></td>
    <td></td>
    <td><strong>{{ $ingresos->total_monto}}</strong></td>
  </tr>
</table>


 @foreach($debitostotal as $egresostotal)

<strong><p>EGRESOS</p></strong>
<table>
<thead>
  <tr>
    <th scope="col">DESCRIPCION</th>
    <th scope="col">ORIGEN</th>
    <th scope="col">MONTO</th>
  </tr>
</thead>
<tbody>
 @foreach($debitosdetalle as $egresosdetalle)
  <tr>
    <td>{{ $egresosdetalle->descripcion}}</td>
    <td>{{ $egresosdetalle->origen}}</td>
    <td>{{ $egresosdetalle->monto}}</td>
  </tr>
  @endforeach
 </tbody>
  <tr>
    <th scope="row">TOTAL</th>
    <td></td>
    <td></td>
    <td><strong>{{ $egresostotal->total_egresos}}</strong></td>
  </tr>
</table>


@foreach($ingresosef as $efectivo)
@foreach($ingresostj as $tarjeta)
<strong><p>SALDO TOTAL</p></strong>
<table>
  <tr>
    <th scope="col">TOTAL EFECTIVO</th>
    <th scope="col">TOTAL TARJETA</th>
    
  </tr>
 
  <tr>
    <td>{{ $efectivo->total_monto_ef}}</td>
    <td>{{ $tarjeta->total_monto_tj}}</td>
  </tr>

   <?php 

$efectivo = $efectivo->total_monto_ef;
$tarjeta = $tarjeta->total_monto_tj;
$totali = $efectivo+$tarjeta;

print_r($totali);

  ;?>
 
 
  <tr>
    <th scope="row">TOTAL</th>
    <td></td>
    <td></td>
    <td><strong>{!!$totali!!}</strong></td>
  </tr>
  @endforeach
  @endforeach  

</table>
<strong><p>SALDO DEL DIA</p></strong>
<table>
  <tr>
    <th scope="col">INGRESOS</th>
    <th scope="col">EGRESOS</th>
  </tr>
 
  <tr>
    <td>{{ $ingresos->total_monto}}</td>
    <td>{{ $egresostotal->total_egresos}}</td>

  </tr>

  <?php 

$ingresos = $ingresos->total_monto;
$egresos = $egresostotal->total_egresos;
$total = $ingresos-$egresos;

print_r($total);

  ;?>

  <tr>
    <th scope="row">TOTAL</th>
    <td></td>
    <td></td>
    <td><strong>{!!$total!!}</strong></td>
  </tr>
</table>
     @endforeach
     @endforeach
  </body>
</html>