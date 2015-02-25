<?php

	// Defines plugin options page and fields.

class dismissAlertBox_options_page {
	
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'dismissAlertBox_options_admin_menu' ) );
		add_action( 'admin_init', array( $this, 'register_pluginfields') );
	}
	
	// Definintion of option field for ...
	public function dismissAlertBox_options_admin_menu () {

		add_theme_page(		'Dismissable Alert Box Options',
							'Alert Box Options',
							'manage_options',
							'manage-dismissalertbox-options.php',
							array($this, 'dismissAlertBox_options_page'));
	}
	
	// Output options page...
	public function dismissAlertBox_options_page () {
		require_once plugin_dir_path( __FILE__ ) . 'options-page.php';
	}
	
	public function register_pluginfields() {
		
		register_setting( 'dismissalertbox-group', 'dismissalertbox_hideonclose', 'intval' );
		register_setting( 'dismissalertbox-group', 'dismissalertbox_preventanimation', 'intval' );
		
	}
	
}