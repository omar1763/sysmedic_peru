<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Historia Mèdica de Paciente</title>
  	<link rel="stylesheet" type="text/css" href="css/pdf.css">

  </head>
  <body>
 @foreach($pacientes as $pac)

  	<p style="text-align: left;"><center><STRONG>HISTORÌA MÈDICA</STRONG></center></p>
    <br><br>
    <p style="text-align: left;"><strong>Nº DE H.C:</strong>{{ $pac->historia}}</p><p style="text-align: right; margin-right: 190px; margin-top: -30px;"><strong>FECHA Y HORA DE ATENCIÒN:</strong></p>

   <br>
   <p style="text-align: left;"><strong>I. DATOS DE AFILIACIÒN:</strong></p> 
   <br>
   <p style="text-align: left;"><strong>APELLIDOS Y NOMBRES:</strong>{{ $pac->apellidos}},{{ $pac->nombres}}</p> 
   <p style="text-align: left;"><strong>EDAD:</strong></p> 
   <p style="text-align: right; margin-top: -30px; margin-right: 400px;"><strong>ESTADO CIVIL:</strong>{{ $pac->edocivil}}</p>
   <p style="text-align: right; margin-top: -30px; margin-right: 100px;"><strong>DNI:</strong>{{ $pac->dni}}</p> 
   <p style="text-align: left;"><strong>FECHA DE NACIMIENTO:</strong>{{ $pac->fechanac}}</p> 
   <p style="text-align: right;margin-top: -30px;margin-right: 200px"><strong>LUGAR DE NACIMIENTO:</strong>{{ $pac->direccion}}</p> 
   <p style="text-align: left;"><strong>OCUPACIÒN:</strong>{{ $pac->ocupacion}}</p> 
   <p style="text-align: right;margin-top: -30px;margin-right: 200px"><strong>GRADO DE INST:</strong>{{ $pac->gradoinstruccion}}</p>
   <p style="text-align: left;"><strong>DOMICILIO ACTUAL:</strong>{{ $pac->direccion}}</p> 
   <p style="text-align: left;"><strong>TELEFONO FIJO:</strong>{{ $pac->telefono}}</p> 
   <p style="text-align: right;margin-top: -30px;margin-right: 200px"><strong>TELEFONO CELULAR:</strong>{{ $pac->telefono}}</p>
   <p style="text-align: left;"><strong>ACOMPAÑANTE:</strong>XXXXX</p> 
   <p style="text-align: right;margin-top: -30px;margin-right: 200px"><strong>PARENTESCO:</strong>XXXXXX</p>
   <br>
   <p style="text-align: left;"><strong>II. ANTECEDENTES:</strong></p> 
   <br>
   <p style="text-align: left;"><strong>ANTECEDENTES FAMILIARES:___________________________________________________________________</strong></p> 
   <p style="text-align: left;"><strong>ANTECEDENTES PERSONALES:___________________________________________________________________</strong></p> 
   <p style="text-align: left;"><strong>ANTECEDENTES PATOLÒGICOS:___________________________________________________________________</strong></p> 
   <br><br>
   <p style="text-align: left;"><strong>III. EXAMENES:</strong></p> 
   <br>
   <p style="text-align: left;"><strong>MOTIVO DE CONSULTA:______________________________________________________________________</strong></p> 
   <p style="text-align: left;"><strong>TIPO DE ENFERMEDAD ACTUAL:____________________</strong></p> 
   <p style="text-align: right;margin-top: -30px;margin-right: 130px"><strong>EVOL. ENF ACTUAL:</strong>____________________</p>
  <p style="text-align: left;"><strong>ENFERMEDAD ACTUAL:_________________________________________________________________________</strong></p> 
  <p style="text-align: left;"><strong>FUNCIONES BIOLÒGICAS:</strong></p> 
  <p style="text-align: left;"><strong>APETITO:</strong></p>
  <p style="text-align: right; margin-top: -30px; margin-right: 600px;"><strong>SED:</strong></p> 
  <p style="text-align: right; margin-top: -30px; margin-right: 400px;"><strong>SUEÑO:</strong></p> 
  <p style="text-align: right; margin-top: -30px; margin-right: 200px;"><strong>ESTADO DE ANIMO:</strong></p> 
  <br>
  <p style="text-align: left;"><strong>IV. EXAMEN FÌSICO GENERAL:</strong></p> 
  <p>______________________________________________________________________________________________</p>
  <p>______________________________________________________________________________________________</p>
  <p>______________________________________________________________________________________________</p>
  <p>______________________________________________________________________________________________</p>
  <p>______________________________________________________________________________________________</p>
  <p>______________________________________________________________________________________________</p>



 

 
 @endforeach


  </body>
</html>