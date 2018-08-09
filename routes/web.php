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
    /*  Route::resource('pacientes', 'Archivos\PacientesController');

     Route::resource('pacientes', 'Archivos\PacientesController', 
        ['names' => [
            'create' => 'pacientes.create',
            'createmodal' => 'pacientes.createmodal',
            'update' => 'pacientes.update',
            'edit' => 'pacientes.edit',
            'store' => 'pacientes.store',
            'show' => 'pacientes.show',
            'destroy' => 'pacientes.destroy',
        ]]);

*/

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



/////// RUTAS DE PACIENTES  ////


    Route::get('/pacientes', function () {return view('pacientes.create');});
    Route::get('/pacientes/create','Archivos\PacientesController@create');
    Route::get('/archivos/pacientes/createmodal', ['uses' => 'Archivos\PacientesController@createmodal', 'as' => 'pacientes.createmodal']);
    Route::post('/pacientes/store', ['uses' => 'Archivos\PacientesController@store', 'as' => 'pacientes.store']);
    Route::post('/pacientes/store2', ['uses' => 'Archivos\PacientesController@store2', 'as' => 'pacientes.store2']);
    Route::get('/pacientes/index',['uses' => 'Archivos\PacientesController@index', 'as' => 'pacientes.index']);
    Route::get('/pacientes/edit/{id}',['uses' => 'Archivos\PacientesController@edit', 'as' => 'pacientes.edit']);
    Route::put('/pacientes/update/{id}',['uses' => 'Archivos\PacientesController@update', 'as' => 'pacientes.update']);
    Route::put('/pacientes/destroy/{id}',['uses' => 'Archivos\PacientesController@destroy', 'as' => 'pacientes.destroy']);





        Route::get('/existencias/atencion/cardainput/{id}','Existencias\AtencionController@cardainput');


   Route::get('/indexFecha/{fecha}','Existencias\AtencionController@indexFecha');

   Route::get('createmodal','Archivos\PacientesController@createmodal');

  Route::get('reportes/index','PdfController@index');
  Route::get('listado_atenciondiaria_ver','Reportes\PdfController@listado_atenciondiaria_ver');
  Route::get('/historia_pacientes_ver/{id}','Reportes\PdfController@historia_pacientes_ver');


    Route::get('/prueba','Existencias\AtencionController@prueba');


