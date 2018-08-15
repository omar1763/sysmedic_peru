<html>
<head>
  <title>Reporte de Atenciones Diarias</title>
    <link rel="stylesheet" type="text/css" href="css/pdf.css">

  </head>
<body>
 
  <main>
    <table>
      
      <thead>
        <tr><th colspan="5" rowspan="" headers="" scope="">
          REPORTE GENERAL
        </th></tr>
        <tr>
          <th>monto</th>
          <th>descripcion</th>
          <th>origen</th>
          <th>tipo_ingreso</th>
          <th>causa</th>
        </tr>
      </thead>
      <tbody>
       @foreach($model as $key => $value)
       <tr>
        <td>{{$value->monto}}</td>
        <td>{{$value->descripcion}}</td>
        <td>{{$value->origen}}</td>
        <td>{{$value->tipo_ingreso}}</td>
        <td>{{$value->causa}}</td>
       
      </tr>


       @endforeach
      </tbody>
    </table>
   
  </main>
  <footer>footer on each page</footer>
</body>
</html>