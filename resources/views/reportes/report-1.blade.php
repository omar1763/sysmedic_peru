<html>
<head>
  <title>Reporte de Atenciones Diarias</title>
    <link rel="stylesheet" type="text/css" href="css/pdf.css">

  </head>
<body>
 
  <main>
    <table>
      
      <thead">
        <tr><th colspan="5" rowspan="" headers="" scope="">
          REPORTE GENERAL
        </th></tr>
        <tr>
          <th>Monto</th>
          <th>Descripcion</th>
          <th>Origen</th>
          <th>Tipo Ingreso</th>
          <th>Causa</th>
        </tr>
      </thead>
      <tbody>
       @foreach($model as $key => $value)
       <tr>
        <td>{{$value->monto}}</td>
        <td>{{$value->descripcion!=''? $value->descripcion:'Si Especificar' }}</td>
        <td>{{$value->origen}}</td>

        <td>
           @if($value->tipo_ingreso=="EF")

        Ingreso en Efectivo
        @else
        Ingreso con Tarjeta

        @endif
        </td>
        <td>{{$value->causa!=''? $value->causa:'Si Especificar' }}</td>
       
      </tr>


       @endforeach
      </tbody>
    </table>
   
  </main>
  <footer>Generado el
<?php
 
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y');

 
?>
  </footer>
</body>
</html>