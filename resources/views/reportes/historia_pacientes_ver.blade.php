<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Historia Mèdica de Paciente</title>
  	<link rel="stylesheet" type="text/css" href="css/pdf.css">

  </head>
  <body>
 @foreach($pacientes as $pac)

  	<p style="text-align: left;"><center><STRONG>HISTORÌA MÈDICA</STRONG></center></p>
    <p style="text-align: left;"><center><strong>{{Auth::user()->empresa}}</strong></center></p>
    <p style="text-align: left;"><strong>Nº DE H.C:</strong>{{ $pac->historia}}</p><p style="text-align: right; margin-right: 190px; margin-top: -30px;"><strong>FECHA Y HORA DE ATENCIÒN:</strong></p>
   <p style="text-align: left;"><strong>I. DATOS DE AFILIACIÒN:</strong></p> 
   <p style="text-align: left;"><strong>APELLIDOS Y NOMBRES:</strong>{{ $pac->apellidos}},{{ $pac->nombres}}</p> 
   <p style="text-align: left;"><strong>EDAD:</strong></p> 
   <p style="text-align: right; margin-top: -30px; margin-right: 400px;"><strong>ESTADO CIVIL:</strong>{{ $pac->edocivil}}</p>
   <p style="text-align: right; margin-top: -30px; margin-right: 100px;"><strong>DNI:</strong>{{ $pac->dni}}</p> 
   <p style="text-align: left;"><strong>FECHA DE NACIMIENTO:</strong>{{ $pac->fechanac}}</p>
   <p style="text-align: right;margin-top: -30px;margin-right: 300px"><strong>DISTRITO:</strong>{{ $pac->distrito}}</p> 
   <p style="text-align: left;"><strong>LUGAR DE NACIMIENTO:</strong>{{ $pac->direccion}}</p> 
   <p style="text-align: left;"><strong>OCUPACIÒN:</strong>{{ $pac->ocupacion}}</p> 
   <p style="text-align: right;margin-top: -30px;margin-right: 200px"><strong>GRADO DE INST:</strong>{{ $pac->gradoinstruccion}}</p>
   <p style="text-align: left;"><strong>DOMICILIO ACTUAL:</strong>{{ $pac->direccion}}</p> 
   <p style="text-align: left;"><strong>TELEFONO FIJO:</strong>{{ $pac->telefono}}</p> 
   <p style="text-align: right;margin-top: -30px;margin-right: 200px"><strong>TELEFONO CELULAR:</strong>{{ $pac->telefono}}</p>
   <p style="text-align: left;"><strong>ACOMPAÑANTE:</strong>XXXXX</p> 
   <p style="text-align: right;margin-top: -30px;margin-right: 200px"><strong>PARENTESCO:</strong>XXXXXX</p>
   <p style="text-align: left;"><strong>II. ANTECEDENTES:</strong></p> 
   <p style="text-align: left;"><strong>ANTECEDENTES FAMILIARES:___________________________________________________________________</strong></p> 
   <p style="text-align: left;"><strong>ANTECEDENTES PERSONALES:___________________________________________________________________</strong></p> 
   <p style="text-align: left;"><strong>ANTECEDENTES PATOLÒGICOS:___________________________________________________________________</strong></p> 
   <p style="text-align: left;"><strong>III. EXAMENES:</strong></p> 
   <p style="text-align: left;"><strong>MOTIVO DE CONSULTA:______________________________________________________________________</strong></p> 
   <p style="text-align: left;"><strong>TIPO DE ENFERMEDAD ACTUAL:____________________</strong></p> 
   <p style="text-align: right;margin-top: -30px;margin-right: 130px"><strong>EVOL. ENF ACTUAL:</strong>____________________</p>
  <p style="text-align: left;"><strong>ENFERMEDAD ACTUAL:</strong>_______________________________________________________________________________
  _______________________________________________________________________________________________________<br>
  _______________________________________________________________________________________________________<br>
  _______________________________________________________________________________________________________<br>
  _______________________________________________________________________________________________________</p> 
  <p style="text-align: left;"><strong>FUNCIONES BIOLÒGICAS:</strong></p> 
  <p style="text-align: left;"><strong>APETITO:</strong></p>
  <p style="text-align: right; margin-top: -30px; margin-right: 600px;"><strong>SED:</strong></p> 
  <p style="text-align: right; margin-top: -30px; margin-right: 400px;"><strong>SUEÑO:</strong></p> 
  <p style="text-align: right; margin-top: -30px; margin-right: 200px;"><strong>ESTADO DE ANIMO:</strong></p> 
  <p style="text-align: left;"><strong>IV. EXAMEN FÌSICO GENERAL:</strong></p> 
  _______________________________________________________________________________________________________<br>
  _______________________________________________________________________________________________________<br>
  _______________________________________________________________________________________________________<br>
  _______________________________________________________________________________________________________<br>
  _______________________________________________________________________________________________________<br>
  _______________________________________________________________________________________________________<br>
  _______________________________________________________________________________________________________<br></p>

  <br><br><br>
  <p style="text-align: left; margin-top: 2px;"><center><STRONG>HISTORÌA CLINICA</STRONG></center></p>
  <p style="text-align: left;"><center><strong>{{Auth::user()->empresa}}</strong></center></p>
  <p style="text-align: left;"><strong>FECHA:</strong></p>
  <p style="text-align: left;"><strong>APELLIDOS Y NOMBRES:</strong>{{ $pac->apellidos}},{{ $pac->nombres}}}</p>
  <p style="text-align: right;margin-top: -30px;margin-right: 300px"><strong>EDAD:</strong></p>
  <p style="text-align: left;"><strong>DIRECCIÒN:</strong>{{ $pac->direccion}}</p>
  <p style="text-align: right;margin-top: -30px;margin-right: 300px"><strong>TELEFONO:</strong>{{ $pac->telefono}}</p>
  <p style="text-align: left;"><strong>ESTADO CIVIL:</strong>{{ $pac->edocivil}}</p> 
  <p style="text-align: right; margin-top: -30px; margin-right: 400px;"><strong>OCUPACIÒN:</strong>{{ $pac->ocupacion}}</p>
  <p style="text-align: right; margin-top: -30px; margin-right: 100px;"><strong>GRADO DE INST:</strong>{{ $pac->gradoinstruccion}}</p> 

  <p style="text-align: left;"><strong>P/A:</strong>_________</p> 
  <p style="text-align: right; margin-top: -30px; margin-right: 580px;"><strong>PULSO:</strong>_________</p>
  <p style="text-align: right; margin-top: -30px; margin-right: 400px;"><strong>TEMPERATURA:</strong>________</p> 
  <p style="text-align: right; margin-top: -30px; margin-right: 280px;"><strong>PESO:</strong>________</p> 
  <p style="text-align: right; margin-top: -30px; margin-right: 200px;"><strong>G:</strong>________</p> 
  <p style="text-align: right; margin-top: -30px; margin-right: 110px;"><strong>P:</strong>________</p> 

  <p style="text-align: left;"><strong>MENARQUIA:</strong>_____________</p> 
  <p style="text-align: right; margin-top: -30px; margin-right: 470px;"><strong>1º R.S:</strong>_____________</p>
  <p style="text-align: right; margin-top: -30px; margin-right: 330px;"><strong>FUR:</strong>_____________</p> 
  <p style="text-align: right; margin-top: -30px; margin-right: 150px;"><strong>R/C:</strong>_____________</p> 

  <p style="text-align: left;"><strong>MAC:</strong>_____________________________</p> 
  <p style="text-align: right; margin-top: -30px; margin-right: 170px;"><strong>FECHA DE ULTIMO PAP:</strong>_____________________________</p>
  <p style="text-align: left;"><strong>ANTECEDENTES FAMILIARES:_____________________________________________________________________</strong></p> 
  <p style="text-align: left;"><strong>ANTECEDENTES PERSONALES:____________________________________________________________________</strong></p> 
  <p style="text-align: left;"><strong>ANTECEDENTES PATOLÒGICOS:___________________________________________________________________</strong></p> 
  <p style="text-align: left;"><strong>ALERGIA:_________________________________________________________________________________________</strong></p> 
  <p style="text-align: left;"><strong>MÒTIVO DE CONSULTA:____________________________________________________________________________</strong></p> 
  <p style="text-align: left;"><strong>TIPO DE ENFERMEDAD:</strong>_________________</p> 
  <p style="text-align: right; margin-top: -30px; margin-right: 150px;"><strong>EVOLUCIÒN DE ENFERMEDAD:</strong>_________________</p>
  <p style="text-align: left;"><strong>FUNCIONES BIOLÒGICAS:____________________________________________________________________</strong>
  </p><strong>EXAMEN FISICO REGIONAL:___________________________________________________________________</strong></p> 
  <p style="text-align: left;"><strong>PRESUNCIÒN DIÀGNOSTICA:</strong>_________________________</p> 
  <p style="text-align: right; margin-top: -30px; margin-right: 200px;"><strong>CIEX:</strong>_________________________</p>
  <p style="text-align: left;"><strong>EXAMENES AUXILIARES:________________________________________________________________</strong>
  </p>
  <p style="text-align: left;"><strong>DIÀGNOSTICO FINAL:</strong>_________________________</p> 
  <p style="text-align: right; margin-top: -30px; margin-right: 200px;"><strong>CIEX:</strong>_________________________</p>
  <p style="text-align: left;"><strong>PLAN DE TRATAMIENTO:____________________________________________________________________</strong>
  </p>
  <p style="text-align: left;"><strong>OBSERVACIONES:____________________________________________________________________</strong>
  </p>
  <br><br><br><br><br><br><br><br>
  <p style="text-align:right; margin-right: 200px;"><strong>FIRMA Y SELLO:</strong></p>

 @endforeach
  </body>
</html>