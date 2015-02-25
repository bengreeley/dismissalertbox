<?php
/*
	Class for custom meta fields for alerts...	
*/
class dismissAlertBoxFields {

	public function __construct() {
		
		add_action( 'add_meta_boxes', array( $this, 'addmetabox' ) );		
		add_action( 'save_post', array( $this, 'dismissalertbox_save_meta_box_data') );
	}
	
	// Registration of meta box....
	public function addmetabox() {

		add_meta_box(
			'dismissalertbox_expiration',
			'Expiration Date',
			array( $this, 'render_dismissalertbox_meta_box' ),
			'dismissalertbox',
			'normal'
		);
				
	}	
	
	// Display the meta box...
	public function render_dismissalertbox_meta_box( $post ) {
	
		wp_nonce_field( 'dismissalertbox', 'dismissalertbox_expirationdate_nonce' );
	
		$expirationDate = get_post_meta( $post->ID, '_dismissalertbox_expirationdate', true );
		
		if( strlen( $expirationDate )) {
			$expirationDate = date('m/d/Y', $expirationDate );
		}
		
		echo '<input type="text" id="dismissalertbox_expirationdate" name="dismissalertbox_expirationdate" value="' . esc_attr( $expirationDate ) . '" size="11" />';
		
		echo '<label for="myplugin_new_field">';
		_e( ' mm/dd/yyyy format', 'dismissalertbox' );
		echo '</label> ';

		return;
	}
	
	/*
		Save field value...
	*/
	public function dismissalertbox_save_meta_box_data( $post_id ) {
	
		if ( ! isset( $_POST['dismissalertbox_expirationdate_nonce'] ) ) {
			return;
		}
	
		if ( ! wp_verify_nonce( $_POST['dismissalertbox_expirationdate_nonce'], 'dismissalertbox' ) ) {
			return;
		}
	
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
	
		if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
	
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
	
		} else {
	
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		}
		
		// Save field...		
		if ( ! isset( $_POST['dismissalertbox_expirationdate'] ) ) {
			return;
		}
		
		if( !strlen( $_POST['dismissalertbox_expirationdate'] ) ) {
			$expirationDate = '';
		}
		else {
			$expirationDate =  strtotime( sanitize_text_field( $_POST['dismissalertbox_expirationdate'] ) );
		}
	
		update_post_meta( $post_id, '_dismissalertbox_expirationdate', $expirationDate );
	}
	
}