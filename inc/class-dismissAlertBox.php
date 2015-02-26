<?php

/* Dismissable alert box class*/
class dismissAlertBox {
	protected $loader;
	protected $plugin_name;
	protected $version;

	public function __construct() {
		$this->plugin_name = 'dismissalertbox';
		$this->version = '1.0.0';
		
		$this->create_custom_posttype();
		$this->define_admin_hooks();		
		$this->define_public_hooks();
	}

	private function define_admin_hooks() {

		if( is_admin() ) {
			// Options...
			require_once( plugin_dir_path( __FILE__ ) . 'admin/class-dismissAlertBox-options.php' );			
			$options_page = new dismissAlertBox_options_page;
			
			$this->dismissalertbox_meta_boxes();
			
		}
		
	}

	private function define_public_hooks() {
		
		if( !is_admin() ) {
						
			// Load CSS...
			wp_register_style( 'dismissalertboxcss', plugins_url('../css/dismissAlertBox.css', __FILE__));	
			wp_enqueue_style('dismissalertboxcss');
			
			// Load JS...
			wp_register_script( 'dismissalertboxjs', plugins_url('../js/dismissAlertBox.js', __FILE__), array( 'jquery' ));	
			wp_enqueue_script('dismissalertboxjs');
			
			add_action( 'wp_footer', array( $this, 'display_dismissAlertBox'), 1);
			
		}
		
	}
	
	private function create_custom_posttype() {

		// Custom post type and fields...
		require_once( plugin_dir_path( __FILE__ ) . 'class-dismissAlertBox-posttype.php' );
		new dismissAlertBox_PostTypes();

	}

	public function get_plugin_name() {
		return $this->plugin_name;
	}

	public function get_version() {
		return $this->version;
	}
	
	public function display_dismissAlertBox() {

		$alertQuery = new WP_Query( array(
							'post_type' => 'dismissalertbox',
							'posts_per_page' => '1'
						) 
		);
		
		if( $alertQuery->have_posts() ) {
			
			while ( $alertQuery->have_posts() ) {
				$alertQuery->the_post();

				$expirationDate = get_post_meta( get_the_id(), '_dismissalertbox_expirationdate', true );

				if( !strlen( $expirationDate ) || ( strlen( $expirationDate ) && $expirationDate > strtotime( 'now' ) ) ) {
				
					if( !isset( $_COOKIE['dismissAlertBoxSet' . get_current_blog_id() . "-" . get_the_id()] ) || 
						get_option('dismissalertbox_hideonclose') == "1" ) { 
						
					// Output alert...
					?>
					<div id="homeMessage" class="<?php echo get_option( 'dismissalertbox_preventanimation' ) != "1"? 'stretchRight':''; ?>" data-site-id="<?php echo get_current_blog_id();?>" data-alert-id="<?php echo get_the_id() ;?>">
						<a href="javascript:void(0)" id="home-close-icon" title="Close"></a>
						
						<h4 id="homeMessageHeader"><?php the_title();?></h4>
						<div id="homeMessageText"><?php the_content(); ?></div>
					</div>
			<?php
					}
				}
				
			}
		}
	}
	
	public function dismissalertbox_meta_boxes() {
		require_once( 'admin/class-dismissAlertBox-fields.php' );
		$fields = new dismissAlertBoxFields();
	}
}