<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    Route::resource('abilities', 'Admin\AbilitiesController');
    Route::post('abilities_mass_destroy', ['uses' => 'Admin\AbilitiesController@massDestroy', 'as' => 'abilities.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('personal', 'Archivos\PersonalController');
    Route::post('personal_mass_destroy', ['uses' => 'Archivos\PersonalController@massDestroy', 'as' => 'personal.mass_destroy']);

    Route::resource('centros', 'Archivos\CentrosController');
    Route::post('centros_mass_destroy', ['uses' => 'Archivos\CentrosController@massDestroy', 'as' => 'centros.mass_destroy']);

    Route::resource('empresas', 'Admin\EmpresasController');
    Route::post('empresas_mass_destroy', ['uses' => 'Archivos\EmpresasController@massDestroy', 'as' => 'empresas.mass_destroy']);

     Route::resource('locales', 'Admin\LocalesController');
    Route::post('localess_mass_destroy', ['uses' => 'Archivos\LocalesController@massDestroy', 'as' => 'localess.mass_destroy']);

    Route::resource('profesionales', 'Archivos\ProfesionalesController');
    Route::post('profesionales_mass_destroy', ['uses' => 'Archivos\ProfesionalesController@massDestroy', 'as' => 'profesionales.mass_destroy']);
    Route::resource('laboratorios', 'Archivos\LaboratoriosController');
    Route::post('laboratorios_mass_destroy', ['uses' => 'Archivos\LaboratoriosController@massDestroy', 'as' => 'laboratorios.mass_destroy']);
    Route::resource('analisis', 'Archivos\AnalisisController');
    Route::post('analisis_mass_destroy', ['uses' => 'Archivos\AnalisisController@massDestroy', 'as' => 'analisis.mass_destroy']);
    Route::resource('sedesafilia', 'Archivos\SedesAfiliaController');
    Route::post('sedesafilia_mass_destroy', ['uses' => 'Archivos\SedesAfiliaController@massDestroy', 'as' => 'sedesafilia.mass_destroy']);
    Route::resource('servicios', 'Archivos\ServiciosController');
    Route::post('servicios_mass_destroy', ['uses' => 'Archivos\ServiciosController@massDestroy', 'as' => 'servicios.mass_destroy']);

    Route::resource('productos', 'Movimientos\ProductosController');
    Route::post('productos_mass_destroy', ['uses' => 'Movimientos\ProductosController@massDestroy', 'as' => 'productos.mass_destroy']);

    Route::resource('ingresos', 'Movimientos\IngresosController');
    Route::post('ingresos_mass_destroy', ['uses' => 'Movimientos\IngresosController@massDestroy', 'as' => 'ingresos.mass_destroy']);

    Route::resource('pacientes', 'Archivos\PacientesController');
    Route::post('pacientes_mass_destroy', ['uses' => 'Archivos\PacientesController@massDestroy', 'as' => 'pacientes.mass_destroy']);


    Route::resource('paquetes', 'Archivos\PaquetesController');
    Route::post('paquetes_mass_destroy', ['uses' => 'Archivos\PaquetesController@massDestroy', 'as' => 'paquetes.mass_destroy']);

    Route::resource('atencion', 'Existencias\AtencionController');
    Route::post('atencion_mass_destroy', ['uses' => 'Existencias\AtencionController@massDestroy', 'as' => 'atencion.mass_destroy']);

    Route::resource('gastos', 'Existencias\GastosController');
    Route::post('gastos_mass_destroy', ['uses' => 'Existencias\GastosController@massDestroy', 'as' => 'gastos.mass_destroy']);
    Route::resource('labporpagar', 'Existencias\LabPorPagarController');
    Route::post('labporpagar_mass_destroy', ['uses' => 'Existencias\LabPorPagarController@massDestroy', 'as' => 'labporpagar.mass_destroy']);

    Route::resource('otrosingresos', 'Existencias\OtrosIngresosController');
    Route::post('otrosingresos_mass_destroy', ['uses' => 'Existencias\OtrosIngresosController@massDestroy', 'as' => 'otrosingresos.mass_destroy']);
    
    Route::resource('resultados', 'Existencias\ResultadosController');
    Route::post('resultados_mass_destroy', ['uses' => 'Existencias\ResultadosController@massDestroy', 'as' => 'resultados.mass_destroy']);

    Route::resource('resultadoslab', 'Existencias\ResultadosLabController');
    Route::post('resultadoslab_mass_destroy', ['uses' => 'Existencias\ResultadosLabController@massDestroy', 'as' => 'resultadoslab.mass_destroy']);

    Route::resource('resultadospaq', 'Existencias\ResultadosPaqController');
    Route::post('resultadospaq_mass_destroy', ['uses' => 'Existencias\ResultadosPaqController@massDestroy', 'as' => 'resultadospaq.mass_destroy']);

    Route::resource('resultadospaqserv', 'Existencias\ResultadosPaqServController');
    Route::post('resultadospaqserv_mass_destroy', ['uses' => 'Existencias\ResultadosPaqServController@massDestroy', 'as' => 'resultadospaqserv.mass_destroy']);

    Route::resource('resultadosguardados', 'Existencias\ResultadosGuardadosController');
    Route::post('resultadosguardados_mass_destroy', ['uses' => 'Existencias\ResultadosGuardadosController@massDestroy', 'as' => 'resultadosguardados.mass_destroy']);

    Route::resource('resultadosguardadoslab', 'Existencias\ResultadosGuardadosLabController');
    Route::post('resultadosguardadoslab_mass_destroy', ['uses' => 'Existencias\ResultadosGuardadosLabController@massDestroy', 'as' => 'resultadosguardadoslab.mass_destroy']);

    Route::resource('resultadosguardadospaq', 'Existencias\ResultadosGuardadosPaqController');
    Route::post('resultadosguardadospaq_mass_destroy', ['uses' => 'Existencias\ResultadosGuardadosPaqController@massDestroy', 'as' => 'resultadosguardadospaq.mass_destroy']);

     Route::resource('resultadosguardadospaqserv', 'Existencias\ResultadosGuardadosPaqServController');
    Route::post('resultadosguardadospaqserv_mass_destroy', ['uses' => 'Existencias\ResultadosGuardadosPaqServController@massDestroy', 'as' => 'resultadosguardadospaqserv.mass_destroy']);

    Route::resource('cuentasporcobrar', 'Existencias\CuentasporCobrarController');
    Route::post('cuentasporcobrar_mass_destroy', ['uses' => 'Existencias\CuentasporCobrarController@massDestroy', 'as' => 'cuentasporcobrar.mass_destroy']);

    Route::resource('comisionesporpagar', 'Existencias\ComisionesPorPagarController');
    Route::post('comisionesporpagar_mass_destroy', ['uses' => 'Existencias\ComisionesPorPagarController@massDestroy', 'as' => 'comisionesporpagar.mass_destroy']);
    Route::resource('comisionespagadas', 'Existencias\ComisionesPagadasController');
    Route::post('comisionespagadas_mass_destroy', ['uses' => 'Existencias\ComisionesPagadasController@massDestroy', 'as' => 'comisionespagadas.mass_destroy']);

    Route::resource('atenciondiaria', 'Reportes\PdfController');
    Route::post('atenciondiaria_mass_destroy', ['uses' => 'Reportes\PdfController@massDestroy', 'as' => 'atenciondiaria.mass_destroy']);
});
    
    Route::get('/paciente/buscar/{dni}', 'Archivos\PacientesController@buscarPacientes');
    Route::get('/existencias/atencion/servbyemp','Archivos\ServiciosController@servbyemp');
    Route::get('/existencias/atencion/paqbyemp','Archivos\PaquetesController@paqbyemp');
    Route::get('/existencias/atencion/perbyemp','Archivos\PersonalController@perbyemp');
    Route::get('/existencias/atencion/probyemp','Archivos\ProfesionalesController@probyemp');
    Route::get('/existencias/atencion/pagoadelantado','Existencias\AtencionController@pagoadelantado');
    Route::get('/existencias/atencion/pagotarjeta','Existencias\AtencionController@pagotarjeta');
    Route::get('/existencias/atencion/dataPacientes/{id}','Existencias\AtencionController@verDataPacientes');
    Route::get('/existencias/atencion/dataServicios/{id}','Existencias\AtencionController@verDataServicios');

    Route::get('/users/locbyemp/{id}','Admin\UsersController@locbyemp');
    Route::get('/pacientes/distbypro/{id}','Archivos\PacientesController@distbypro');



/////// RUTAS DE PACIENTES  ////


    Route::get('/pacientes', function () {return view('pacientes.create');});
    Route::get('/pacientes/create','Archivos\PacientesController@create');
    Route::get('/archivos/pacientes/createmodal', ['uses' => 'Archivos\PacientesController@createmodal', 'as' => 'pacientes.createmodal']);
    Route::post('/pacientes/store', ['uses' => 'Archivos\PacientesController@store', 'as' => 'pacientes.store']);
    Route::post('/pacientes/store2', ['uses' => 'Archivos\PacientesController@store2', 'as' => 'pacientes.store2']);
    Route::get('/pacientes/index',['uses' => 'Archivos\PacientesController@index', 'as' => 'pacientes.index']);
    Route::get('/pacientes/edit/{id}',['uses' => 'Archivos\PacientesController@edit', 'as' => 'pacientes.edit']);
    Route::get('/pacientes/ver/{id}',['uses' => 'Archivos\PacientesController@ver', 'as' => 'pacientes.ver']);
    Route::put('/pacientes/update/{id}',['uses' => 'Archivos\PacientesController@update', 'as' => 'pacientes.update']);
    Route::put('/pacientes/destroy/{id}',['uses' => 'Archivos\PacientesController@destroy', 'as' => 'pacientes.destroy']);
  //  Route::get('/atencion/editar/{id}',['uses' => 'Archivos\PacientesController@edit', 'as' => 'pacientes.edit']);


 Route::put('/comisionesporpagar/destroylab/{id}',['uses' => 'Existencias\ComisionesPorPagarController@destroylab', 'as' => 'comisionesporpagar.destroylab']);



   Route::get('/existencias/atencion/cardainput/{id}','Existencias\AtencionController@cardainput');
   Route::get('/existencias/atencion/cardainput2/{id}','Existencias\AtencionController@cardainput2');
   Route::get('/existencias/atencion/cardainput3/{id}','Existencias\AtencionController@cardainput3');

   Route::get('/movimientos/productos/index2','Movimientos\ProductosController@index2')->name('admin.productos.index2');


   Route::get('/indexFecha/{fecha}','Existencias\AtencionController@indexFecha');
   Route::get('/selectproduct/{id}','Existencias\AtencionController@selectproduct');

   Route::get('createmodal','Archivos\PacientesController@createmodal');
   Route::get('/total','Reportes\PdfController@totalDiario');

  Route::get('reportes/index','PdfController@index');
  Route::get('listado_atenciondiaria_ver','Reportes\PdfController@listado_atenciondiaria_ver')->name('listado_atenciondiaria_ver');
  Route::get('/historia_pacientes_ver/{id}','Reportes\PdfController@historia_pacientes_ver');
  Route::get('/recibo_profesionales_ver/{id}','Reportes\PdfController@recibo_profesionales_ver');
  Route::get('/resultados_ver/{id}','Reportes\PdfController@resultados_ver')->name('resultados');
  Route::get('/resultados_lab_ver/{id}','Reportes\PdfController@resultados_lab_ver')->name('resultados_lab');
  Route::get('/resultados_lab_paq_ver/{id}','Reportes\PdfController@resultados_lab_paq_ver')->name('resultados_lab_paq');
  Route::get('/resultados_lab_paq_serv_ver/{id}','Reportes\PdfController@resultados_lab_paq_serv')->name('resultados_lab_paq_serv');


  Route::get('/ticket_atencion_ver/{id}','Reportes\PdfController@ticket_atencion_ver');

   Route::get('/existencias/cuentasporcobrar/pagar/{id}', ['uses' => 'Existencias\CuentasporCobrarController@pagar', 'as' => 'admin.cuentasporcobrar.pagar']);



    Route::get('/prueba','Existencias\AtencionController@prueba');
    Route::put('destroylab', 'Existencias\ComisionesPorPagarController@destroylab')->name('admin.comisionesporpagar.destroylab');



  
    Route::group(['prefix' => 'reportes'], function () {
        Route::post('reportegeneral', 'ReportesController@reportegeneral');
        Route::get('filtro-general', 'ReportesController@filtrogeneral')->name('filtros');


        
    });



     Route::get('pacientesreport', 'ReportesController@pacientes');
     Route::get('serviciosreport', 'ReportesController@servicios');
     Route::get('analisisreport', 'ReportesController@analisis');
     Route::get('reportes', 'ReportesController@index')->name('reportes');


