<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Title
	|--------------------------------------------------------------------------
	|
	| Here you can change the default title of your admin panel.
	|
	| For more detailed instructions you can look here:
	| https://github.com/jeroennoten/Laravel-AdminLTE/#61-title
	|
	*/

	'title' => 'Titanium Telecom',
	'title_prefix' => '',
	'title_postfix' => '',

	/*
	|--------------------------------------------------------------------------
	| Favicon
	|--------------------------------------------------------------------------
	|
	| Here you can activate the favicon.
	|
	| For more detailed instructions you can look here:
	| https://github.com/jeroennoten/Laravel-AdminLTE/#62-favicon
	|
	*/

	'use_ico_only' => false,
	'use_full_favicon' => false,

	/*
	|--------------------------------------------------------------------------
	| Logo
	|--------------------------------------------------------------------------
	|
	| Here you can change the logo of your admin panel.
	|
	| For more detailed instructions you can look here:
	| https://github.com/jeroennoten/Laravel-AdminLTE/#63-logo
	|
	*/

	'logo' => '<b>Titanium</b>Telecom',
	'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
	// 'logo_img' => 'svg/40codelogo.svg',
	'logo_img_class' => 'brand-image img-circle elevation-3-purple',
	'logo_img_xl' => null,
	'logo_img_xl_class' => 'brand-image-xs',
	'logo_img_alt' => '40code',

	/*
	|--------------------------------------------------------------------------
	| User Menu
	|--------------------------------------------------------------------------
	|
	| Here you can activate and change the user menu.
	|
	| For more detailed instructions you can look here:
	| https://github.com/jeroennoten/Laravel-AdminLTE/#64-user-menu
	|
	*/

	'usermenu_enabled' => true,
	'usermenu_header' => false,
	'usermenu_header_class' => 'bg-primary',
	'usermenu_image' => false,
	'usermenu_desc' => false,
	'usermenu_profile_url' => false,

	/*
	|--------------------------------------------------------------------------
	| Layout
	|--------------------------------------------------------------------------
	|
	| Here we change the layout of your admin panel.
	|
	| For more detailed instructions you can look here:
	| https://github.com/jeroennoten/Laravel-AdminLTE/#65-layout
	|
	*/

	'layout_topnav' => null,
	'layout_boxed' => null,
	'layout_fixed_sidebar' => true,
	'layout_fixed_navbar' => true,
	'layout_fixed_footer' => null,

	/*
	|--------------------------------------------------------------------------
	| Authentication Views Classes
	|--------------------------------------------------------------------------
	|
	| Here you can change the look and behavior of the authentication views.
	|
	| For more detailed instructions you can look here:
	| https://github.com/jeroennoten/Laravel-AdminLTE/#661-authentication-views-classes
	|
	*/

	'classes_auth_card' => 'card-outline card-navy',
	'classes_auth_header' => '',
	'classes_auth_body' => '',
	'classes_auth_footer' => '',
	'classes_auth_icon' => '',
	'classes_auth_btn' => 'btn-flat btn-primary',

	/*
	|--------------------------------------------------------------------------
	| Admin Panel Classes
	|--------------------------------------------------------------------------
	|
	| Here you can change the look and behavior of the admin panel.
	|
	| For more detailed instructions you can look here:
	| https://github.com/jeroennoten/Laravel-AdminLTE/#662-admin-panel-classes
	|
	*/

	'classes_body' => '',
	'classes_brand' => '',
	'classes_brand_text' => '',
	'classes_content_wrapper' => '',
	'classes_content_header' => '',
	'classes_content' => '',
	'classes_sidebar' => 'sidebar-dark-indigo elevation-4 bg-navy',
	'classes_sidebar_nav' => '',
	'classes_topnav' => 'navbar-white navbar-light',
	'classes_topnav_nav' => 'navbar-expand',
	'classes_topnav_container' => 'container',

	/*
	|--------------------------------------------------------------------------
	| Sidebar
	|--------------------------------------------------------------------------
	|
	| Here we can modify the sidebar of the admin panel.
	|
	| For more detailed instructions you can look here:
	| https://github.com/jeroennoten/Laravel-AdminLTE/#67-sidebar
	|
	*/

	'sidebar_user' => false,
	'sidebar_mini' => true,
	'sidebar_collapse' => false,
	'sidebar_collapse_auto_size' => false,
	'sidebar_collapse_remember' => true,
	'sidebar_collapse_remember_no_transition' => true,
	'sidebar_scrollbar_theme' => 'os-theme-light',
	'sidebar_scrollbar_auto_hide' => 'l',
	'sidebar_nav_accordion' => true,
	'sidebar_nav_animation_speed' => 200,

	/*
	|--------------------------------------------------------------------------
	| Control Sidebar (Right Sidebar)
	|--------------------------------------------------------------------------
	|
	| Here we can modify the right sidebar aka control sidebar of the admin panel.
	|
	| For more detailed instructions you can look here:
	| https://github.com/jeroennoten/Laravel-AdminLTE/#68-control-sidebar-right-sidebar
	|
	*/

	'right_sidebar' => false,
	'right_sidebar_icon' => 'fad fa-cogs',
	'right_sidebar_theme' => 'dark',
	'right_sidebar_slide' => true,
	'right_sidebar_push' => true,
	'right_sidebar_scrollbar_theme' => 'os-theme-light',
	'right_sidebar_scrollbar_auto_hide' => 'l',

	/*
	|--------------------------------------------------------------------------
	| URLs
	|--------------------------------------------------------------------------
	|
	| Here we can modify the url settings of the admin panel.
	|
	| For more detailed instructions you can look here:
	| https://github.com/jeroennoten/Laravel-AdminLTE/#69-urls
	|
	*/

	'use_route_url' => true,

	'dashboard_url' => '',

	'logout_url' => 'logout',

	'login_url' => 'login',

	// 'register_url' => 'register',

	// 'password_reset_url' => 'password.request',
	'password_reset_url' => false,

	// 'password_email_url' => 'password.email',

	'profile_url' => false,

	/*
	|--------------------------------------------------------------------------
	| Laravel Mix
	|--------------------------------------------------------------------------
	|
	| Here we can enable the Laravel Mix option for the admin panel.
	|
	| For more detailed instructions you can look here:
	| https://github.com/jeroennoten/Laravel-AdminLTE/#610-laravel-mix
	|
	*/

	'enabled_laravel_mix' => true,
	'laravel_mix_css_path' => 'css/app.css',
	'laravel_mix_js_path' => 'js/app.js',

	/*
	|--------------------------------------------------------------------------
	| Menu Items
	|--------------------------------------------------------------------------
	|
	| Here we can modify the sidebar/top navigation of the admin panel.
	|
	| For more detailed instructions you can look here:
	| https://github.com/jeroennoten/Laravel-AdminLTE/#611-menu
	|
	*/

	'menu' => [
		[
			'text' => 'search',
			'search' => false,
			'topnav' => false,
		],
		[
			'text' => 'blog',
			'url' => 'admin/blog',
			'can' => 'gerentes',
		],
		[
			'text' => 'dashboard',
			'route' => 'dashboard.',
			'icon' => 'fad fa-home',
			'can' => 'gerente',
		],
		[
			'text' => 'Chamados',
			'icon' => 'fad fa-headset',
			'active' => ['*/chamados/*', '*/*/chamados/*', 'regex:@^chamados/[0-9]+$@'],
			'submenu' => [
				[
					'text' => 'Aberto',
					'icon_color' => 'warning',
					// 'icon' => 'fad fa-folder-open',
					'route' => 'dashboard.chamados.abertos'
				],
				[
					'text' => 'Concluído',
					'icon_color' => 'success',
					// 'icon' => 'fad fa-check-double',
					'route' => 'dashboard.chamados.concluido'
				],
				[
					'text' 		 => 'Pendente',
					'icon_color' => 'danger',
					// 'icon' 		 => 'fad fa-check-double',
					'route' 	 => 'dashboard.chamados.pendentes'
				],
				[
					'text' 		 => 'Novo',
					// 'icon_color' => 'success',
					'icon' 		 => 'fad fa-plus',
					'route' 	 => 'dashboard.chamados.create'
				],
				[
					'text' 		 => 'Todos',
					// 'icon_color' => 'info',
					'icon' 		 => 'fad fa-clipboard-list',
					'route' 	 => 'dashboard.chamados.index'
				],
			]
		],


		[
			'text' 		=> 'Técnicos',
			'route' 	=> 'dashboard.tecnicos.index',
			'icon' 		=> 'fad fa-cog',
			'active' 	=> ['*/tecnicos/*', '*/*/tecnicos/*', 'regex:@^tecnicos/[0-9]+$@']
		],
		[
			'text' 		=> 'Analistas',
			'icon' 		=> 'fad fa-users',
			'can' 		=> 'gerente',
			'route' 	=> 'dashboard.users.index',
			'active' 	=> ['*/users/*']
		],

		[
			'text'	=> 'Clientes',
			'icon'	=> 'fad fa-cogs',
			'active' => ['*/clientes/*', '*/*/clientes/*', 'regex:@^clientes/[0-9]+$@'],
			'submenu' => [
				[
					'text'	=> 'Cliente',
					'icon'	=> 'fad fa-user',
					'route'	=> 'dashboard.clientes.index'
				],
				[
					'text'	=> 'Subcliente',
					'icon'	=> 'fad fa-users',
					'route'	=> 'dashboard.subclientes.index'
				]
			]
		],

		[
			'text' => 'reports',
			'icon' => 'fad fa-list',
			'can'  => 'gerente',
			'active' => ['*/report/*', '*/*/report/*', 'regex:@^report/[0-9]+$@'],
			'submenu' => [
				[
					'text' 		=> 'Por Cidade',
					'route' 	=> 'dashboard.report.city',
					'icon' 		=> 'fal fa-map-signs',
					'active' => ['*/cidade/*', '*/*/cidade/*', 'regex:@^cidade/[0-9]+$@'],
				],
				[
					'text' 		=> 'Por Cliente',
					'route' 	=> 'dashboard.report.client',
					'icon' 		=> 'fad fa-user',
					'active' => ['*/cliente/*', '*/*/cliente/*', 'regex:@^cliente/[0-9]+$@'],
				],
				[
					'text' 		=> 'Por sub-cliente',
					'route' 	=> 'dashboard.report.subclient',
					'icon' 		=> 'fad fa-user-friends',
					'active' => ['*/subcliente/*', '*/*/subcliente/*', 'regex:@^subcliente/[0-9]+$@'],
				],
				[
					'text' 		=> 'Por prefixo',
					'route' 	=> 'dashboard.report.agency',
					'icon' 		=> 'fad fa-comment-dollar',
					'active' => ['*/agencia/*', '*/*/agencia/*', 'regex:@^agencia/[0-9]+$@'],
				],
			]
		],
		
		['header' => 'account_settings'],
		[
			'text' 		=> 'profile',
			'route' 	=> 'dashboard.perfil.index',
			'icon' 		=> 'fad fa-user',
		],
		/* [
			'text' 		=> 'change_password',
			'route'  	=> 'password.request',
			'icon' 		=> 'fad fa-lock',
		], */
		
		['header' => 'labels'],
		[
			'text' 		 => 'Aberto',
			'icon_color' => 'yellow',
			'icon'		 => 'fad fa-circle',
			'url' 		 => '#',
		],
		[
			'text' 		 => 'Fechado',
			'icon_color' => 'red',
			'icon'		 => 'fad fa-circle',
			'url' 		 => '#',
		],		
		[
			'text' 		 => 'Finalizado',
			'icon_color' => 'green',
			'icon'		 => 'fad fa-circle',
			'url' 		 => '#',
		],
		[
			'text' 		 => 'Em andamento',
			'icon_color' => 'secondary',
			'icon'		 => 'fad fa-circle',
			'url' 		 => '#',
		],
	],

	/*
	|--------------------------------------------------------------------------
	| Menu Filters
	|--------------------------------------------------------------------------
	|
	| Here we can modify the menu filters of the admin panel.
	|
	| For more detailed instructions you can look here:
	| https://github.com/jeroennoten/Laravel-AdminLTE/#612-menu-filters
	|
	*/

	'filters' => [
		JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
		JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
		JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
		JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
		JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
		JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
		JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
		JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
	],

	/*
	|--------------------------------------------------------------------------
	| Plugins Initialization
	|--------------------------------------------------------------------------
	|
	| Here we can modify the plugins used inside the admin panel.
	|
	| For more detailed instructions you can look here:
	| https://github.com/jeroennoten/Laravel-AdminLTE/#613-plugins
	|
	*/

	'plugins' => [
		[
			'name' => 'Datatables',
			'active' => false,
			'files' => [
				[
					'type' => 'js',
					'asset' => false,
					'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
				],
				[
					'type' => 'js',
					'asset' => false,
					'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
				],
				[
					'type' => 'css',
					'asset' => false,
					'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
				],
			],
		],
		[
			'name' => 'Select2',
			'active' => false,
			'files' => [
				[
					'type' => 'js',
					'asset' => false,
					'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
				],
				[
					'type' => 'css',
					'asset' => false,
					'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
				],
			],
		],
		[
			'name' => 'Chartjs',
			'active' => false,
			'files' => [
				[
					'type' => 'js',
					'asset' => false,
					'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
				],
			],
		],
		[
			'name' => 'Sweetalert2',
			'active' => false,
			'files' => [
				[
					'type' => 'js',
					'asset' => false,
					'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
				],
			],
		],
		[
			'name' => 'Pace',
			'active' => false,
			'files' => [
				[
					'type' => 'css',
					'asset' => false,
					'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
				],
				[
					'type' => 'js',
					'asset' => false,
					'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
				],
			],
		],
	],
];
