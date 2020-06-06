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
	'logo_img_class' => 'brand-image img-circle elevation-3',
	'logo_img_xl' => null,
	'logo_img_xl_class' => 'brand-image-xs',
	'logo_img_alt' => 'JhoneDEV',

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
	'usermenu_header' => true,
	'usermenu_header_class' => 'bg-purple',
	'usermenu_image' => false,
	'usermenu_desc' => true,

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
	'layout_fixed_navbar' => null,
	'layout_fixed_footer' => null,

	/*
	|--------------------------------------------------------------------------
	| Extra Classes
	|--------------------------------------------------------------------------
	|
	| Here you can change the look and behavior of the admin panel.
	|
	| For more detailed instructions you can look here:
	| https://github.com/jeroennoten/Laravel-AdminLTE/#66-classes
	|
	*/

	'classes_body' => '',
	'classes_brand' => '',
	'classes_brand_text' => '',
	'classes_content_header' => '',
	'classes_content' => '',
	'classes_sidebar' => 'sidebar-dark-primary elevation-4',
	'classes_sidebar_nav' => '',
	'classes_topnav' => 'navbar-white navbar-light',
	'classes_topnav_nav' => 'navbar-expand-md',
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

	'sidebar_mini' => true,
	'sidebar_collapse' => false,
	'sidebar_collapse_auto_size' => false,
	'sidebar_collapse_remember' => true,
	'sidebar_collapse_remember_no_transition' => true,
	'sidebar_scrollbar_theme' => 'os-theme-light',
	'sidebar_scrollbar_auto_hide' => 'l',
	'sidebar_nav_accordion' => true,
	'sidebar_nav_animation_speed' => 300,

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
	'right_sidebar_icon' => 'fas fa-cogs',
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
	'register_url' => 'register',
	// 'password_reset_url' => 'password/reset',
	'password_reset_url' => '',
	'password_email_url' => 'password/email',
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
		/*[
				'search' => false,
				'url' => 'test',  //form action
				'method' => 'POST', //form method
				'input_name' => 'menu-search-input', //input name
				'text' => 'Procurar', //input placeholder
				'topnav' => false,
		],*/
		[
			'text' => 'Painel de controle',
			'route' => 'dashboard.',
			'icon' => 'fas fa-fw fa-home',
			'can' => 'gerente'
		],
		'MENU',
		[
			'text' => 'Chamados',
			'icon' => 'fas fa-cog',
			'submenu' => [
				[
					'text' => 'Aberto',
					'icon_color' => 'warning',
					'icon' => 'fas fa-fw fa-folder-open',
					'route' => 'dashboard.chamados.abertos'
				],
				[
					'text' => 'Concluído',
					'icon_color' => 'success',
					'icon' => 'fas fa-fw fa-check-double',
					'route' => 'dashboard.chamados.concluido'
				],
				[
					'text' => 'Pendente',
					'icon_color' => 'danger',
					'icon' => 'fas fa-fw fa-check-double',
					'route' => 'dashboard.chamados.pendentes'
				],
				[
					'text' => 'Novo',
					'icon_color' => 'success',
					'icon' => 'fas fa-fw fa-plus',
					'route' => 'dashboard.chamados.create'
				],
				[
					'text' => 'Todos',
					'icon_color' => 'info',
					'icon' => 'fas fa-fw fa-clipboard-list',
					'route' => 'dashboard.chamados.index'
				],
			],
		],
		[
			'text' => 'Técnicos',
			'route' => 'dashboard.tecnicos.index',
			'icon' => 'fas fa-cog'
		],
		[
			'text'	=> 'Analistas',
			'icon'	=> 'fas fa-users',
			'icon_color' => 'cyan',
			'can'		=> 'gerente',
			'route'	=> 'dashboard.users.index'
		],
		['header' => 'account_settings'],
		[
			'text' => 'profile',
			'url' => 'admin/settings',
			'icon' => 'fas fa-fw fa-user',
		],
		['header' => 'labels'],
		[
			'text' => 'important',
			'icon_color' => 'red',
		],
		[
			'text' => 'warning',
			'icon_color' => 'yellow',
		],
		[
			'text' => 'information',
			'icon_color' => 'cyan',
		],
		[
			'text' => 'Desconectar',
			'icon' => 'fas fa-fw fa-sign-out-alt',
			'icon_color' => 'red',
			'route' => 'logout'
		]
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
