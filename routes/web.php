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


        Route::get('/existencias/atencion/cardainput/{id}','Existencias\AtencionController@cardainput');




  Route::get('reportes/index','PdfController@index');
  Route::get('listado_atenciondiaria_ver','Reportes\PdfController@listado_atenciondiaria_ver');


    Route::get('/prueba','Existencias\AtencionController@prueba');


