<?php
/**
* Class for creation of custom post type and and extra fields that will be shown...
*/
class dismissAlertBox_PostTypes {
	public function __construct() {

		add_action( 'init', array($this, 'create_dismissalertbox_posttype' ));		
		add_action( 'init', array($this, 'create_dismissalertbox_fields' ));
	}
	
	public function create_dismissalertbox_posttype() {
		
		if( !post_type_exists('dismissalertbox') ) {
			
			register_post_type( 'dismissalertbox',
				array(
					'labels' => array(
						'name' => __( 'Dismissable Alerts' ),
						'singular_name' => __( 'Alert' ),
						'add_new_item'  => __( 'Add New Alert', 'dismissalertbox' ),
						'edit_item'          => __( 'Edit Alert', 'dismissalertbox' ),
						'view_item'          => __( 'View Alert', 'dismissalertbox' ),
					),
					'public' => true,
					'has_archive' => true,
					'menu_icon' => 'dashicons-testimonial',
					'rewrite' => array('slug' => 'dismissalertbox'),
					'supports' => array(
										'editor',
										'title'
									)
				)
			);
		}
	}
	
	public function create_dismissalertbox_fields() {
		
		return;	
	}
}