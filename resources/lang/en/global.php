<?phpreturn [		'user-management' => [		'title' => 'Administraciòn',		'created_at' => 'Time',		'fields' => [		],	],		'abilities' => [		'title' => 'Acciones',		'created_at' => 'Time',		'fields' => [			'name' => 'Name',		],	],		'roles' => [		'title' => 'Roles',		'created_at' => 'Time',		'fields' => [			'name' => 'Name',			'abilities' => 'Abilities',		],	],		'users' => [		'title' => 'Usuarios',		'created_at' => 'Time',		'fields' => [			'name' => 'Name',			'email' => 'Email',			'password' => 'Password',			'roles' => 'Roles',			'remember-token' => 'Remember token',		],	],	'sedesafilia' => [		'title' => 'Sedes Afiliadas',		'created_at' => 'Time',		'fields' => [			'nombre' => 'Nombre',			'direccion' => 'Direcciòn',			'telefono' => 'Telefono',			'fechaafilia' => 'Fecha de Afiliaciòn',		],	],	'archivos' => [		'title' => 'Archivos',		'created_at' => 'Time',		'fields' => [		],	],		'personal' => [		'title' => 'Personal',		'created_at' => 'Time',		'fields' => [			'nombres' => 'Nombres',			'apellidos' => 'Apellidos',			'dni' => 'DNI',			'telefono' => 'Telefono',			'direccion' => 'Direcciòn',		],	],		'profesionales' => [		'title' => 'Prof. de Apoyo',		'created_at' => 'Time',		'fields' => [			'nombres' => 'Nombres',			'apellidos' => 'Apellidos',			'cmp' => 'CMP',			'telefono' => 'Telefono',			'especialidad' => 'Especialidad',			'id_centromedico' => 'Centro Mèdico',		],	],		'centros' => [		'title' => 'Centros Mèdicos',		'created_at' => 'Time',		'fields' => [			'nombre' => 'Nombre',			'direccion' => 'Direccion',			'referencia' => 'Referencia',					],	],	'profesionales' => [		'title' => 'Prof. de Apoyo',		'created_at' => 'Time',		'fields' => [			'nombres' => 'Nombres',			'apellidos' => 'Apellidos',			'especialidad' => 'Especialidad',			'centro' => 'Centro Mèdico',			'cmp' => 'CMP',			'nacimiento' => 'Fecha Nacimiento',					],	],		'laboratorio' => [		'title' => 'Laboratorios',		'created_at' => 'Time',		'fields' => [			'nombre' => 'Nombres',			'direccion' => 'Direccion',			'referencia' => 'Referencia',					],	],		'analisis' => [		'title' => 'Analisis de Laboratorios',		'created_at' => 'Time',		'fields' => [			'nombre' => 'Nombre',			'laboratorio' => 'Laboratorio',			'preciopublico' => 'Precio Publico',			'costlab' => 'Costo de Laboratorio',		],	],	'servicios' => [		'title' => 'Servicios',		'created_at' => 'Time',		'fields' => [			'detalle' => 'Detalle ',			'precio' => 'Precio',			'porcentaje' => 'Porcentaje',				],	],	'pacientes' => [		'title' => 'Pacientes',		'created_at' => 'Time',		'fields' => [			'nombres' => 'Nombres',			'apellidos' => 'Apellidos',			'especialidad' => 'Especialidad',			'centro' => 'Centro Mèdico',			'cmp' => 'CMP',			'nacimiento' => 'Fecha Nacimiento',					],	],	'app_create' => 'Crear',	'app_save' => 'Guardar',	'app_edit' => 'Editar',	'app_view' => 'Ver',	'app_update' => 'Actualizar',	'app_list' => 'List',	'app_no_entries_in_table' => 'No entries in table',	'custom_controller_index' => 'Custom controller index.',	'app_logout' => 'Cerrar Sesiòn',	'app_add_new' => 'Agregar Nuevo',	'app_are_you_sure' => 'Are you sure?',	'app_back_to_list' => 'Back to list',	'app_dashboard' => 'Menu Principal',	'app_delete' => 'Eliminar',	'global_title' =>'SYSMEDIC ADMIN',];