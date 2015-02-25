<?php
/*
Plugin Name: Dismissable Alert Box
Plugin URI: http://www.bengreeley.com
Description: Alert box to show a temporary message that is dismissable by user. The box will not reappear if user has dismissed previously to make less annoying.
Version: 1.0
Author: Ben Greeley
Author URI: http://www.bengreeley.com
	
*/

/*  
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Plugin activation hooks...
function activate_dismissable_alert_box() {
	require_once plugin_dir_path( __FILE__ ) . 'inc/class-dismissAlertBox-activator.php';
	dismissAlertBox_Activator::activate();
}

register_activation_hook( __FILE__, 'activate_dismissable_alert_box' );

// Plugin deactivation hooks...
function deactivate_dismissable_alert_box() {
	require_once plugin_dir_path( __FILE__ ) . 'inc/class-dismissAlertBox-deactivator.php';
	dismissAlertBox_Deactivator::deactivate();
}

register_deactivation_hook( __FILE__, 'deactivate_dismissable_alert_box' );

require plugin_dir_path( __FILE__) . 'inc/class-dismissAlertBox.php';

new dismissAlertBox();