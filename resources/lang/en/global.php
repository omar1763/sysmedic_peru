<?phpreturn [		'user-management' => [		'title' => 'Administraciòn',		'created_at' => 'Time',		'fields' => [		],	],		'abilities' => [		'title' => 'Acciones',		'created_at' => 'Time',		'fields' => [			'name' => 'Name',		],	],		'roles' => [		'title' => 'Roles',		'created_at' => 'Time',		'fields' => [			'name' => 'Name',			'abilities' => 'Abilities',		],	],		'users' => [		'title' => 'Usuarios',		'created_at' => 'Time',		'fields' => [			'name' => 'Name',			'email' => 'Email',			'password' => 'Password',			'roles' => 'Roles',			'remember-token' => 'Remember token',			'empresa' => 'Empresa',			'sucursal' => 'Sucursal',		],	],	'sedesafilia' => [		'title' => 'Sedes Afiliadas',		'created_at' => 'Time',		'fields' => [			'nombre' => 'Nombre',			'direccion' => 'Direcciòn',			'telefono' => 'Telefono',			'fechaafilia' => 'Fecha de Afiliaciòn',		],	],	'archivos' => [		'title' => 'Archivos',		'created_at' => 'Time',		'fields' => [		],	],		'personal' => [		'title' => 'Personal',		'created_at' => 'Time',		'fields' => [			'name' => 'Nombres',			'apellidos' => 'Apellidos',			'dni' => 'DNI',			'telefono' => 'Telefono',			'direccion' => 'Direcciòn',		],	],		'profesionales' => [		'title' => 'Prof. de Apoyo',		'created_at' => 'Time',		'fields' => [			'name' => 'Nombres',			'apellidos' => 'Apellidos',			'cmp' => 'CMP',			'telefono' => 'Telefono',			'especialidad' => 'Especialidad',			'id_centromedico' => 'Centro Mèdico',		],	],		'centros' => [		'title' => 'Centros Mèdicos',		'created_at' => 'Time',		'fields' => [			'nombre' => 'Nombre',			'direccion' => 'Direccion',			'referencia' => 'Referencia',					],	],	'profesionales' => [		'title' => 'Prof. de Apoyo',		'created_at' => 'Time',		'fields' => [			'nombres' => 'Nombres',			'apellidos' => 'Apellidos',			'especialidad' => 'Especialidad',			'centro' => 'Centro Mèdico',			'cmp' => 'CMP',			'nacimiento' => 'Fecha Nacimiento',					],	],		'laboratorio' => [		'title' => 'Laboratorios',		'created_at' => 'Time',		'fields' => [			'name' => 'Nombres',			'direccion' => 'Direccion',			'referencia' => 'Referencia',					],	],		'analisis' => [		'title' => 'Analisis de Laboratorios',		'created_at' => 'Time',		'fields' => [			'name' => 'Nombre',			'laboratorio' => 'Laboratorio',			'preciopublico' => 'Precio Publico',			'costlab' => 'Costo de Laboratorio',		],	],	'servicios' => [		'title' => 'Servicios',		'created_at' => 'Time',		'fields' => [			'detalle' => 'Detalle ',			'precio' => 'Precio',			'porcentaje' => 'Porcentaje',				],	],	'pacientes' => [		'title' => 'Pacientes',		'created_at' => 'Time',		'fields' => [			'nombres' => 'Nombres',			'apellidos' => 'Apellidos',			'dni' => 'DNI',			'direccion' => 'Direccion',			'provincia' => 'Provincia',			'distrito' => 'Distrito',			'telefono' => 'Telefono',			'edocivil' => 'Edo Civil',			'gradoinstruccion' => 'Grado de Instrucciòn',			'fechanac' => 'Fecha de Nacimiento',			'ocupacion' => 'Ocupaciòn',			'historia' => 'Historia Clinica',					],	],	'movimientos' => [		'title' => 'Movimientos',		'created_at' => 'Time',		'fields' => [		],	],	'productos' => [		'title' => 'Productos',		'created_at' => 'Time',		'fields' => [			'nombre' => 'Nombre',			'cantidad' => 'Cantidad',			'medida' => 'Medida',			'fecha' => 'Fecha',			],	],	'existencias' => [		'title' => 'Actualizar Existencias',		'created_at' => 'Time',		'fields' => [			'nombre' => 'Nombre',			'cantidad' => 'Cantidad',			'medida' => 'Medida',			'fecha' => 'Fecha de Ingreso'			],	],	'ingresos' => [		'title' => 'Ingreso de Productos',		'created_at' => 'Time',		'fields' => [			'producto' => 'Nombre de Producto',			'cantidad' => 'Cantidad',			'fecha' => 'Fecha de Ingreso'		],	],	'app_create' => 'Crear',	'app_save' => 'Guardar',	'app_edit' => 'Editar',	'app_view' => 'Ver',	'app_update' => 'Actualizar',	'app_list' => 'Lista',	'app_no_entries_in_table' => 'No hay registros',	'custom_controller_index' => 'Custom controller index.',	'app_logout' => 'Cerrar Sesiòn',	'app_add_new' => 'Agregar Nuevo',	'app_are_you_sure' => 'Estás seguro?',	'app_back_to_list' => 'Volver a la lista',	'app_dashboard' => 'Menu Principal',	'app_delete' => 'Eliminar',	'global_title' =>'SYSMEDIC ADMIN',];