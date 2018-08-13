<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Reporte de Atenciones Diarias</title>
  	<link rel="stylesheet" type="text/css" href="css/pdf.css">

  </head>
  <body>
 @foreach($creditos as $ingresos)
  @foreach($servicios as $serv)
  @foreach($serviciosmonto as $servmonto)
   @foreach($otrosingresos as $otros)
    @foreach($otrosingresosmonto as $otrosmonto)

 @foreach($empresasucursal as $es)

  	<p style="text-align: left;"><center><STRONG>EMPRESA:</STRONG>{{ $es->empresa}}</center></p>
    <p style="text-align: left;"><center><STRONG>SUCURSAL:</STRONG>{{ $es->sucursal}}</center></p>
 @endforeach
  <br>
 
  <p style="margin-left: 15px; float: left;">Fecha:<?=date('d/m/Y');?></p>
  <p style="margin-left: 450px; float:left;">Hora:<?=date('g:ia');?></p>
 
  <br><br><br>
<table>
  <tr>
    <th scope="col">INGRESOS</th>
    <th scope="col">CANTIDAD</th>
    <th scope="col">MONTO</th>
  </tr>
  <tr>
    <td>Servicios</td>
    <td>{{ $serv->total_servicios}}</td>
    <td>{{ $servmonto->total_monto_servicios}}</td>
  </tr>
 
  <tr>
    <td>Otros Ingresos</td>
    <td>{{ $otros->total_otrosingresos}}</td>
    <td>{{ $otrosmonto->total_monto_otrosingresos}}</td>
  </tr>
 
  <tr>
    <td>Cuentas por Cobrar</td>
    <td>0</td>
    <td>0</td>
  </tr>
 
  <tr>
    <th scope="row">TOTAL</th>
    <td></td>
    <td></td>
    <td><strong>{{ $ingresos->total_monto}}</strong></td>
  </tr>
</table>
 @endforeach
 @endforeach
  @endforeach
 @endforeach


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
 
 
  <tr>
    <th scope="row">TOTAL</th>
    <td></td>
    <td></td>
    <td><strong>{{ $ingresos->total_monto}}</strong></td>
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
 
  <tr>
    <th scope="row">TOTAL</th>
    <td></td>
    <td></td>
    <td><strong>XX</strong></td>
  </tr>
</table>
     @endforeach
     @endforeach
  </body>
</html>